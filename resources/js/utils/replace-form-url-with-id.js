export default function changeFormUrlWithId(id, defaultUrl, formSelector){
    const newUrl = defaultUrl.replace(":id", id);
    $(formSelector).attr("action", newUrl);
}
