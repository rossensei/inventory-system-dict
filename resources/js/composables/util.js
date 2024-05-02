export function useRemoveEmptyKeys (obj) {
    Object.keys(obj).forEach(key => {
        if(obj[key] == '' || obj[key] == null) {
            delete obj[key];
        }
    })

    return obj;
}