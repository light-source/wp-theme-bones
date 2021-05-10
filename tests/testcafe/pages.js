import {Selector} from 'testcafe';

fixture`Pages`;

const DOMAIN = 'http://theme.loc';
const DO_NOT_CACHE = '';

const pages = [
    //////// blog
    {
        name: 'Demo',
        page: '/demo/',
        elements: [
            '.demo-page',
            '.demo-page__first',
        ],
    },
];

//////// script

async function visitPage(page, test) {

    // a first slash already exists
    let url = DOMAIN + page + DO_NOT_CACHE;
    await test.navigateTo(url);

}

async function checkElements(selectors, test) {

    for (let i = 0; i < selectors.length; i++) {

        let isSelectorExists = await Selector(selectors[i]).exists;

        // help for debugging
        if (!isSelectorExists) {
            console.log('[' + selectors[i] + ']');
        }

        await test.expect(isSelectorExists).ok();

    }

}

async function checkCommonElements(test, isWithBreadcrumbs = true) {

    let commonElements = [
        //'.mega-menu--theme--main .mega-menu-item__nav-link',
        //'.mega-footer--theme--main .mega-footer__menu-item-text',
    ];

    if (isWithBreadcrumbs) {
        //commonElements.push('.g-breadcrumbs .g-breadcrumbs__text');
    }

    await checkElements(commonElements, test);

}

for (let i = 0; i < pages.length; i++) {

    let name = pages[i].name;
    let page = pages[i].page;
    let elements = pages[i].elements;
    let isWithBreadcrumbs = !pages[i].hasOwnProperty('isWithoutBreadcrumbs');

    test(name, async test => {

        await visitPage(page, test);
        await checkCommonElements(test, isWithBreadcrumbs);
        await checkElements(elements, test);

    });

}
