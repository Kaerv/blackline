{extends file='page.tpl'}
{block name="page_content"}
<section id="quotes-section">
    <div id="filters-container">
        <div id="filters-header">
            <div id="filters-title">FILTRY</div>
            <div id="clear-filters">
                <span>Wyczyść filtry</span>
                <img src="/assets/icons/close.svg">
            </div>
        </div>
        <div id="categories-filters" class="filters">
            <div class="filter-title">Kategorie</div>
            <div id="category-search" class="filter-search">
                <input type="text" placeholder="Wyszukaj kategorie" id="category-search-input">
                <img src="/assets/icons/search.svg"> 
            </div>
            <div class="filter-values-list">
                <div class="filter-value-container">
                    <div class="filter-value">
                        <span>Miłość</span>
                        <img src="/assets/icons/close.svg">
                    </div>
                </div>
                <div class="filter-value-container">
                    <div class="filter-value selected">
                        <span>Miłość</span>
                        <img src="/assets/icons/close.svg">
                    </div>
                </div>
                <div class="filter-value-container">
                    <div class="filter-value">
                        <span>Miłość</span>
                        <img src="/assets/icons/close.svg">
                    </div>
                </div>
            </div>
        </div>
        <div id="authors-filters" class="filters">
            <div class="filter-title">Autor</div>
            <div id="author-search" class="filter-search">
                <input type="text" placeholder="Wyszukaj autora" id="author-search-input">
                <img src="/assets/icons/search.svg"> 
            </div>
            <div class="filter-values-list">
                <div class="filter-value-container">
                    <div class="filter-value selected">
                        <span>Stephen King</span>
                        <img src="/assets/icons/close.svg">
                    </div>
                </div>
                <div class="filter-value-container">
                    <div class="filter-value selected">
                        <span>Andrzej Sapkowski</span>
                        <img src="/assets/icons/close.svg">
                    </div>
                </div>
                <div class="filter-value-container">
                    <div class="filter-value">
                        <span>Wisława Szymborska</span>
                        <img src="/assets/icons/close.svg">
                    </div>
                </div>
            </div>
            <div id="best-authors">
                <div class="checkbox-list-title">Najbardziej lubiani autorzy:</div>
                <div class="checkbox-list">
                    <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="thomas-hardy" id="thomas-hardy" type="checkbox">
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">Andrzej Piasecki</div>
                            </label>
                        </span>
                    </div>
                                        <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="thomas-hardy" id="thomas-hardy" type="checkbox">
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">Andrzej Piasecki</div>
                            </label>
                        </span>
                    </div>
                                        <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="thomas-hardy" id="thomas-hardy" type="checkbox">
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">Andrzej Piasecki</div>
                            </label>
                        </span>
                    </div>
                </div>
            </div>

            <div id="all-authors">
                <div class="checkbox-list-title" id="all-authors-title">
                    Pokaż wszystkich autorów
                    <img src="/assets/icons/down-arrow.svg" id="all-authors-button"> 
                </div>
                <div class="scrollbar-inner checkbox-list" id="all-authors-list">
                    <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="thomas-hardy" id="thomas-hardy" type="checkbox">
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">Andrzej Piasecki</div>
                            </label>
                        </span>
                    </div>
                    <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="thomas-hardy" id="thomas-hardy" type="checkbox">
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">Andrzej Piasecki</div>
                            </label>
                        </span>
                    </div>
                    <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="thomas-hardy" id="thomas-hardy" type="checkbox">
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">Andrzej Piasecki</div>
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="quotes-container">
        <div id="sort-container">
            <div>Sortuj:</div>
            <div id="sort-options">
                <div id="sort-input">
                    <div id="sort-actual">Popularne</div>
                    <img src="/assets/icons/down-arrow.svg">
                </div>
                <div id="quote-sort-list">
                    <div class="sort-option">Najnowsze</div>
                    <div class="sort-option">Najstarsze</div>
                    <div class="sort-option">Alfabetycznie</div>
                </div>
            </div>
        </div>
    </div>
</section>
{/block}