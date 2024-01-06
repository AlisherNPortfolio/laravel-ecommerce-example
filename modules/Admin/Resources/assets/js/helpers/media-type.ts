type media = 'image'|'video';
function defineMediaType(mediaExtension: string): media {
    switch(mediaExtension) {
        case 'png':
        case 'jpg':
        case 'jpeg':
        case 'webp':
        case 'bmp':
        case 'svg': return 'image';
        case 'mp4':
        case 'mkv': return 'video';
    }
}

export default function media_type(mediaName: string): media {
    let mediaContentArray = mediaName.split('.');

    return defineMediaType(mediaContentArray[mediaContentArray.length - 1]);
}
