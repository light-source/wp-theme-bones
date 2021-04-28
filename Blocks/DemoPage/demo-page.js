(function () {

    window.wpThemeBones = window.wpThemeBones || {};
    let bemBlock = window.wpThemeBones.bemBlock || null;

    if (!bemBlock) {
        throw new Error("Required dependency is missing");
    }

    const DEMO_PAGE = {
        "class": {
            "ELEMENT": "demo-page",
            "MESSAGE": "demo-page__message",
        }
    };

    class DemoPage extends bemBlock.Class {

        constructor(element) {

            super(element);

            this._init();

        }

        _init() {

            this.getElement().querySelector("." + DEMO_PAGE.class.MESSAGE).textContent = "(dynamic js string - block's code has an access to an external dependency)";
        }

    }

    bemBlock.Register("." + DEMO_PAGE.class.ELEMENT, DemoPage);

}());
