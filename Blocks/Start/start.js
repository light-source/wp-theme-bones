import bemBlock from '../BemBlock/bem-block';
import Vue from 'vue';

const START = {
    "class": {
        "ELEMENT": "start",
    },
};

class Start extends bemBlock.Class {


    //////// constructor


    constructor(element) {

        super(element);

        this._data = {
            introText: 'Hello Vue!',
        };

        this._vue = new Vue({
            el: element,
            data: this._data,
            methods: {
                onIntroClick: this.onIntroClick.bind(this),
            },
        });

    }


    //////// methods

    //// events

    onIntroClick(event) {

        this._data.introText += "?";

    }

}

bemBlock.Register('.' + START.class.ELEMENT, Start);
