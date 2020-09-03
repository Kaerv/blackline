<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

include_once _PS_MODULE_DIR_ . 'ps_emailsubscription/ps_emailsubscription.php';

class Blackline_Newsletter extends Module
{
    public function __construct() {
        $this->name = 'blackline_newsletter';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Krystian Kordal';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Newsletter');
        $this->description = $this->l('Newsletter BLACKLINE');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install() {
        if (!parent::install() ||
        !$this->registerHook('displayNewsletter') ||
        !$this->registerHook('actionFrontControllerSetMedia') ||
        !Configuration::updateValue('NEWSLETTER_WELCOME_MESSAGE', 'Dziękujemy za dołączenie do newslettera blackline') ||
        !Configuration::updateValue('NEWSLETTER_SEND_WELCOME', true) ||
        !Configuration::updateValue('NEWSLETTER_EMAILS', serialize(array()))) {
        return false;
        }

        return true;
    }

    public function uninstall() {
        if(
            !parent::uninstall() ||
            !Configuration::deleteByName('NEWSLETTER_WELCOME_MESSAGE') ||
            !Configuration::deleteByName('NEWSLETTER_EMAILS') ||
            !Configuration::deleteByName('NEWSLETTER_SEND_WELCOME')
        ) {
            return false;
        }
        else return true;
    }

    public function hookDisplayNewsletter($params) {
        
        return $this->display(__FILE__, 'blackline_newsletter.tpl');
    }

    public function hookActionFrontControllerSetMedia() {
        $this->context->controller->addCSS(
            $this->_path.'views/css/blackline_newsletter.css', 'all'
        );

        $this->context->controller->addJS(
            $this->_path.'views/js/blackline_newsletter.js', 'all'
        );
    }

    public function getContent() {
    $output = null;

    if (Tools::isSubmit('submit'.$this->name)) {
        $welcomeMessage = strval(Tools::getValue('NEWSLETTER_WELCOME_MESSAGE'));
        $sendWelcome = strval(Tools::getValue('NEWSLETTER_SEND_WELCOME'));

        if (
            !$welcomeMessage ||
            empty($welcomeMessage)
        ) {
            $output .= $this->displayError($this->l('Invalid Configuration value'));
        } else {
            Configuration::updateValue('NEWSLETTER_WELCOME_MESSAGE', $welcomeMessage);
            Configuration::updateValue('NEWSLETTER_SEND_WELCOME', $sendWelcome);
            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }
    }

    return $output.$this->displayForm();
    }

    public function displayForm() {
    $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');

    $fieldsForm[0]['form'] = [
        'legend' => [
            'title' => "WIADOMOŚĆ POWITALNA",
        ],
        'input' => [
            [
                'type' => 'textarea',
                'label' => 'Wiadomość powitalna',
                'name' => 'NEWSLETTER_WELCOME_MESSAGE',
                'size' => 20,
                'required' => true
            ],
            [
                'type' => 'switch',
                'label' => 'Wysyłać wiadomość powitalną?',
                'name' => 'NEWSLETTER_SEND_WELCOME',
                'values' => array(
                    array(
                        'id' => 'active_on',
                        'value' => 1,
                        'label' => $this->trans('Yes', array(), 'Admin.Global'),
                    ),
                    array(
                        'id' => 'active_off',
                        'value' => 0,
                        'label' => $this->trans('No', array(), 'Admin.Global'),
                    ),
                ),
            ]
        ],
        'submit' => [
            'title' => $this->l('Save'),
            'class' => 'btn btn-default pull-right'
        ]
    ];



    $helper = new HelperForm();

    $helper->module = $this;
    $helper->name_controller = $this->name;
    $helper->token = Tools::getAdminTokenLite('AdminModules');
    $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

    $helper->default_form_language = $defaultLang;
    $helper->allow_employee_form_lang = $defaultLang;

    $helper->title = $this->displayName;
    $helper->show_toolbar = true;        // false -> remove toolbar
    $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
    $helper->submit_action = 'submit'.$this->name;
    $helper->toolbar_btn = [
        'save' => [
            'desc' => $this->l('Save'),
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
            '&token='.Tools::getAdminTokenLite('AdminModules'),
        ],
        'back' => [
            'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Back to list')
        ]
    ];

    // Load current value
    $helper->fields_value['NEWSLETTER_SEND_WELCOME'] = Tools::getValue('NEWSLETTER_SEND_WELCOME', Configuration::get('NEWSLETTER_SEND_WELCOME'));
    $helper->fields_value['NEWSLETTER_WELCOME_MESSAGE'] = Tools::getValue('NEWSLETTER_WELCOME_MESSAGE', Configuration::get('NEWSLETTER_WELCOME_MESSAGE'));

    return $helper->generateForm($fieldsForm);
    }

    public function registerEmail($mail) {
        $subscription = new Ps_Emailsubscription();
        $isPrestaShopVersionOver177 = version_compare(_PS_VERSION_, '1.7.7', '>=');

        if (empty($mail) || !Validate::isEmail($mail)) {
            return $this->error = $this->trans('Invalid email address.', array(), 'Shop.Notifications.Error');

        } else {

            $register_status = $subscription->isNewsletterRegistered($mail);
            if ($register_status > 0) {
                return $this->error = $this->trans('This email address is already registered.', array(), 'Modules.Emailsubscription.Shop');
            }

            $email = pSQL($_POST['email']);
            if (!$subscription->isRegistered($register_status)) {
                if (Configuration::get('NW_VERIFICATION_EMAIL')) {

                    // create an unactive entry in the newsletter database
                    if ($register_status == self::GUEST_NOT_REGISTERED) {
                        $subscription->registerGuest($email, false);
                    }

                    if (!$token = $this->getToken($email, $register_status)) {
                        return $this->error = $this->trans('An error occurred during the subscription process.', array(), 'Modules.Emailsubscription.Shop');
                    }

                    $this->sendVerificationEmail($email, $token);

                    return $this->valid = $this->trans('A verification email has been sent. Please check your inbox.', array(), 'Modules.Emailsubscription.Shop');

                } else {
                    if ($subscription->register($email, $register_status)) {
                        $this->valid = $this->trans('You have successfully subscribed to this newsletter.', array(), 'Modules.Emailsubscription.Shop');
                    } else {
                        return $this->error = $this->trans('An error occurred during the subscription process.', array(), 'Modules.Emailsubscription.Shop');
                    }

                    if ($code = Configuration::get('NW_VOUCHER_CODE')) {
                        $this->sendVoucher($email, $code);
                    }

                    if (Configuration::get('NW_CONFIRMATION_EMAIL')) {
                        $this->sendConfirmationEmail($email);
                    }
                }
            }
        }
        // hook
        Hook::exec(
            'actionNewsletterRegistrationAfter',
            [
                'hookName' => $hookName,
                'email' => $_POST['email'],
                'action' => $_POST['action'],
                'error' => &$this->error,
            ]
        );

    }
}