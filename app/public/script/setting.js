let new_image_input = document.querySelector("#fileToUpload");
let depose = document.querySelector("#depose");

depose.addEventListener("click", function(evt) {
    evt.preventDefault();
    new_image_input.click();
    new_image_input.addEventListener("change", openVignette);
});

depose.addEventListener("dragover", function(evt) {
    evt.preventDefault();
});
depose.addEventListener("dragenter", function() {
    this.className="onDropZone";
});
depose.addEventListener("dragleave", function() {
    this.className="";
});
depose.addEventListener("drop", function(evt) {
    evt.preventDefault();
    new_image_input.files=evt.dataTransfer.files;
    this.className="";
    openVignette()
});

// affiche la mignature de l'image upload
function openVignette() {
    let p=document.querySelector("#preview");
    p.innerHTML="";
    for (let i=0; i<new_image_input.files.length; i++) {
        let f=new_image_input.files[i];
        let div=document.createElement("div");
        div.className="fichier";
        let vignette=document.createElement("img");
        vignette.src = window.URL.createObjectURL(f);
        div.appendChild(vignette);
        p.appendChild(div);
    }
    p.style.display="block";
};