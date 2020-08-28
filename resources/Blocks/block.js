import Log from './Log/log';

const BLOCK = {
    "attr": {
        "BLOCK_INSTANCE": "_blockInstance",
        "DATA_BLOCK": "data-block",
    },
};

let _blocksInstance = null;

class Block {


    //////// constructor


    constructor(element) {

        this._element = element;

        // mark the element as already init (special for vue.js, because it re-create html in a constructor)
        element.setAttribute(BLOCK.attr.DATA_BLOCK, 'block');

    }


    //////// getters


    getElement() {

    }

}

class Blocks {


    //////// constructor


    constructor() {

        this._blocks = [];
        this._mutationObserver = null;

        'loading' === document.readyState ?
            document.addEventListener('DOMContentLoaded', this.onDocumentReady.bind(this)) :
            this.onDocumentReady();

    }

    //////// static methods

    static Instance() {

        if (!_blocksInstance) {
            _blocksInstance = new Blocks();
        }

        return _blocksInstance;
    }

    //////// methods

    _initBlock(block, environment = null) {

        environment = !environment ?
            document.body :
            environment;

        let elements = Array.from(environment.querySelectorAll(block.elementSelector));

        if (environment.matches(block.elementSelector)) {
            elements.push(environment);
        }

        elements.forEach((element, index) => {

            // ignore the element if a block already init
            // (special for vue.js, because it re-create html in a constructor)
            // also required placed there, because it's a right way for the environment with inner blocks

            if (element.getAttribute(BLOCK.attr.DATA_BLOCK)) {
                return;
            }

            let blockInstance = null;

            try {
                blockInstance = new block.classLink(element);
            } catch (exception) {

                let logMessage = "Fail create a new block";
                let logDebugArgs = {
                    block: block,
                    element: element,
                    environment: environment,
                    exception: exception,
                };
                Log.write(Log.level.ERROR, logMessage, logDebugArgs);

                return;
            }


        });

    }

    _onMutationCallback(records, observer) {

        records.forEach((record, index) => {

            record.addedNodes.forEach((element, index2) => {

                this._blocks.forEach((block, index3) => {

                    this._initBlock(block, element);

                });

            });

        });

    }

    register(elementSelector, classLink) {

        let block = {
            elementSelector: elementSelector,
            classLink: classLink,
        };

        this._blocks.push(block);

        'loading' === document.readyState ?
            document.addEventListener('DOMContentLoaded', this._initBlock.bind(this, block, null)) :
            this._initBlock(block);


    }

    //// events

    onDocumentReady() {

        if (!'MutationObserver' in window) {

            let logMessage = "MutationObserver doesn't supported";
            let logDebugArgs = {};
            Log.write(Log.level.WARNING, logMessage, logDebugArgs);

            return ''
        }

        this._mutationObserver = new MutationObserver(this._onMutationCallback.bind(this));
        this._mutationObserver.observe(document.body, {
            childList: true,
            subtree: true,
        });

    }

}


export default {
    Class: Block,
    Register: (elementSelector, classLink) => {
        Blocks.Instance().register(elementSelector, classLink);
    },
}
