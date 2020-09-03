import Log from '../Log/log';
import bemBlock from '@lightsource/bem-block';

bemBlock.settings.ERROR_CALLBACK = function (errors) {

    let logMessage = 'Something wrong with a bem block';
    let logDebugArgs = {
        errors: errors,
    };
    Log.write(Log.level.WARNING, logMessage, logDebugArgs);

};

export default bemBlock;
