function parsePrice(value) {
    return parseInt(value.replace('đ', '').replace(/,/g, '').trim()) || 0;
}

function buildUrl(params) {
    const orderedParams = [{key: 'category', value: params.category}, {key: 'min', value: params.min}, {
        key: 'max',
        value: params.max
    }, {key: 'sortBy', value: params.sortBy}, {
        key: 'orderBy',
        value: params.sortBy === 'price' ? params.orderBy : null
    }, {key: 'page', value: params.page || '1'}];
    const filteredParams = orderedParams.filter(param => {
        if (param.key === 'sortBy' && param.value === 'pop') return false;
        if (param.key === 'page' && param.value === '1') return false;
        return param.value !== null && param.value !== '';
    });
    const query = filteredParams
        .map(param => `${param.key}=${encodeURIComponent(param.value)}`)
        .join('&');
    return query ? `${window.location.pathname}?${query}` : window.location.pathname;
}

document.addEventListener('DOMContentLoaded', function () {
    // Dependency check
    if (typeof noUiSlider === 'undefined') {
        console.error('noUiSlider library is not loaded.');
        return;
    }

    const elements = {
        minPrice: document.getElementById('minPrice'),
        maxPrice: document.getElementById('maxPrice'),
        filterForm: document.getElementById('filterForm'),
        minPriceInput: document.getElementById('minPriceInput'),
        maxPriceInput: document.getElementById('maxPriceInput'),
        priceRange: document.getElementById('priceRange'),
        appliedFilters: document.getElementById('appliedFilters'),
        filterTags: document.getElementById('filterTags'),
        sortByPop: document.getElementById('sortByPop'),
        sortByCtime: document.getElementById('sortByCtime'),
        priceSort: document.getElementById('priceSort')
    };

    if (Object.values(elements).some(el => !el)) {
        console.error('One or more required elements not found.');
        return;
    }

    const urlParams = new URLSearchParams(window.location.search);
    const defaultMinPrice = parsePrice(elements.minPriceInput.value);
    const defaultMaxPrice = parsePrice(elements.maxPriceInput.value);
    const urlMinPrice = urlParams.has('min') ? parsePrice(urlParams.get('min')) : defaultMinPrice;
    const urlMaxPrice = urlParams.has('max') ? parsePrice(urlParams.get('max')) : defaultMaxPrice;
    const currentSortBy = urlParams.get('sortBy') || 'pop';

    if (!urlParams.has('sortBy')) {
        const initialParams = {
            category: urlParams.get('category'),
            min: urlMinPrice !== defaultMinPrice ? urlMinPrice : null,
            max: urlMaxPrice !== defaultMaxPrice ? urlMaxPrice : null,
            sortBy: 'pop',
            orderBy: null,
            page: urlParams.get('page')
        };
        window.history.replaceState({}, '', buildUrl(initialParams));
    }

    noUiSlider.create(elements.priceRange, {
        start: [urlMinPrice, urlMaxPrice],
        connect: true,
        range: {'min': defaultMinPrice, 'max': defaultMaxPrice},
        step: 100000,
        format: {
            to: value => `${parseInt(value).toLocaleString()}đ`,
            from: value => parseInt(value.replace('đ', '').replace(',', ''))
        }
    });

    function updatePriceDisplay(values) {
        const minValue = parsePrice(values[0]);
        const maxValue = parsePrice(values[1]);
        elements.minPrice.textContent = values[0];
        elements.maxPrice.textContent = values[1];
        elements.minPriceInput.value = minValue;
        elements.maxPriceInput.value = maxValue;
        updateAriaAttributes(minValue, maxValue);
        updateAppliedFilters(minValue, maxValue);
    }

    function updateAriaAttributes(minValue, maxValue) {
        elements.priceRange.querySelectorAll('.noUi-handle').forEach((handle, index) => {
            const value = index === 0 ? minValue : maxValue;
            handle.setAttribute('aria-valuemin', defaultMinPrice);
            handle.setAttribute('aria-valuemax', defaultMaxPrice);
            handle.setAttribute('aria-valuenow', value);
            handle.setAttribute('aria-valuetext', `${value.toLocaleString()}đ`);
        });
    }

    function createFilterTag(label, value, isMin = true) {
        const tag = document.createElement('span');
        tag.className = 'inline-flex items-center px-3 py-1 bg-orange-100 text-orange-800 text-sm font-medium rounded-full border border-orange-300';
        tag.innerHTML = `
                ${label} ${value.toLocaleString()}đ
                <button class="ml-2 text-orange-500 hover:text-orange-700 focus:outline-none" data-filter="${isMin ? 'min' : 'max'}">×</button>
            `;
        return tag;
    }

    function updateAppliedFilters(minValue, maxValue) {
        elements.filterTags.innerHTML = '';
        if (minValue !== defaultMinPrice || maxValue !== defaultMaxPrice) {
            if (minValue !== defaultMinPrice) elements.filterTags.appendChild(createFilterTag('Nhỏ nhất', minValue, true));
            if (maxValue !== defaultMaxPrice) elements.filterTags.appendChild(createFilterTag('Lớn nhất', maxValue, false));
            elements.appliedFilters.classList.remove('hidden');
        } else {
            elements.appliedFilters.classList.add('hidden');
        }
    }

    function resetFilter(type) {
        const currentParams = new URLSearchParams(window.location.search);
        const params = {
            category: currentParams.get('category'),
            min: type === 'min' ? null : (currentParams.get('min') ? parsePrice(currentParams.get('min')) : null),
            max: type === 'max' ? null : (currentParams.get('max') ? parsePrice(currentParams.get('max')) : null),
            sortBy: currentParams.get('sortBy') || 'pop',
            orderBy: currentParams.get('sortBy') === 'price' ? currentParams.get('orderBy') : null,
            page: currentParams.get('page')
        };
        window.location.href = buildUrl(params);
    }

    elements.filterForm.addEventListener('submit', function (event) {
        event.preventDefault();
        let minValue = parsePrice(elements.minPriceInput.value) || defaultMinPrice;
        let maxValue = parsePrice(elements.maxPriceInput.value) || defaultMaxPrice;
        [minValue, maxValue] = [Math.min(minValue, maxValue), Math.max(minValue, maxValue)];
        const currentParams = new URLSearchParams(window.location.search);
        const params = {
            category: currentParams.get('category'),
            min: minValue !== defaultMinPrice ? minValue : null,
            max: maxValue !== defaultMaxPrice ? maxValue : null,
            sortBy: currentParams.get('sortBy') || 'pop',
            orderBy: currentParams.get('sortBy') === 'price' ? currentParams.get('orderBy') : null,
            page: '1'
        };
        window.location.href = buildUrl(params);
    });

    elements.filterTags.addEventListener('click', function (event) {
        if (event.target.tagName === 'BUTTON') resetFilter(event.target.getAttribute('data-filter'));
    });

    elements.priceRange.noUiSlider.on('update', updatePriceDisplay);

    document.querySelectorAll('a[href^="?category="]').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            const hrefParams = new URLSearchParams(this.getAttribute('href').split('?')[1] || '');
            const selectedCategory = hrefParams.get('category') || null;
            const currentParams = new URLSearchParams(window.location.search);
            const params = {
                category: selectedCategory,
                min: currentParams.get('min'),
                max: currentParams.get('max'),
                sortBy: currentParams.get('sortBy') || 'pop',
                orderBy: currentParams.get('sortBy') === 'price' ? currentParams.get('orderBy') : null,
                page: currentParams.get('page')
            };
            window.location.href = buildUrl(params);
        });
    });

    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const currentParams = new URLSearchParams(window.location.search);
            const hrefParams = new URLSearchParams(new URL(this.href, window.location.origin).search);
            const pageNumber = hrefParams.get('page');
            const params = {
                category: currentParams.get('category'),
                min: currentParams.get('min'),
                max: currentParams.get('max'),
                sortBy: currentParams.get('sortBy') || 'pop',
                orderBy: currentParams.get('sortBy') === 'price' ? currentParams.get('orderBy') : null,
                page: pageNumber || '1'
            };
            const newUrl = buildUrl(params);
            window.history.pushState({}, '', newUrl);
            window.location.href = newUrl;
        });
    });

    if (currentSortBy === 'pop') elements.sortByPop.classList.add('bg-orange-600', 'border-orange-600'); else if (currentSortBy === 'ctime') elements.sortByCtime.classList.add('bg-orange-600', 'border-orange-600'); else if (currentSortBy === 'price') {
        elements.priceSort.classList.add('border-orange-600', 'text-orange-600');
        elements.priceSort.value = urlParams.get('orderBy') || '';
    }

    updatePriceDisplay([urlMinPrice.toLocaleString() + 'đ', urlMaxPrice.toLocaleString() + 'đ']);
});

function updateUrl(param1, value1, param2 = null, value2 = null) {
    const currentParams = new URLSearchParams(window.location.search);
    const newSortBy = param1 === 'sortBy' ? value1 : currentParams.get('sortBy') || 'pop';
    const params = {
        category: currentParams.get('category'),
        min: currentParams.get('min') ? parsePrice(currentParams.get('min')) : null,
        max: currentParams.get('max') ? parsePrice(currentParams.get('max')) : null,
        sortBy: newSortBy,
        orderBy: newSortBy === 'price' && param2 === 'orderBy' && value2 ? value2 : (newSortBy === 'price' ? currentParams.get('orderBy') : null),
        page: '1'
    };
    window.location.href = buildUrl(params);
}
