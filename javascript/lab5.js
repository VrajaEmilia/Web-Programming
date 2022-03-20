function setNewImage(image)
{
    document.getElementById("biggerImg").hidden = false;
    document.getElementById("biggerImg").src = image.src;
}
function setOld()
{
    document.getElementById("biggerImg").src=null;
    document.getElementById("biggerImg").hidden = true;
}