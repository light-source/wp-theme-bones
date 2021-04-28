import bemBlock from '../../node-js/node_modules/@lightsource/bem-block';

(function () {

    bemBlock.settings.ERROR_CALLBACK = function (errors) {

        let logMessage = 'Something wrong with a bem block';
        let logDebugArgs = {
            errors: errors,
        };
        console.log(logMessage, logDebugArgs);

    };

    window.wpThemeBones = window.wpThemeBones || {};
    window.wpThemeBones.bemBlock = bemBlock;

}());

