const formModifyArticle = document.querySelectorAll(".modifyForm");
formModifyArticle.forEach((form) => {
    form.style.display = "none";
});

const formDisplayComment = document.querySelectorAll(".commentForm");
formDisplayComment.forEach((form) => {
    form.style.display = "none";
});

const openModifyArticle = document.querySelectorAll(".modify");
openModifyArticle.forEach((button) => {
    let isVisible = false;
    button.onclick = (e) => {
        const formToDisplay = e.target.nextElementSibling;
        isVisible = !isVisible;
        formToDisplay.style.display = isVisible ? "block" : "none";
        e.target.innerHTML = isVisible ? "Annuler" : "Modifier";
    };
});

const seeComments = document.querySelectorAll(".seeComments");
seeComments.forEach((commentButton) => {
    let isVisible = false;
    commentButton.onclick = (e) => {
        const formToDisplay = e.target.nextElementSibling;
        let section = formToDisplay.nextElementSibling;
        isVisible = !isVisible;
        formToDisplay.style.display = isVisible ? "block" : "none";
        section.style.display = isVisible ? "block" : "none";
        e.target.innerHTML = isVisible ? "Annuler" : "Commentaires";
        let postId = formToDisplay.elements[1].value;
        const api = async () => {
            section.innerHTML = "";
            formToDisplay.elements[0].value = "";
            const res = await fetch(`/comment/${postId}`);
            const data = await res.json();

            data.forEach(comment => {
                let content = comment.content;
                let author = comment.author;
                let date = comment.createdAt.date;
                date = date.split('.')[0];
                let div = document.createElement("div");
                let span = document.createElement("span");
                let span2 = document.createElement("span");
                let span3 = document.createElement("span");
                let br = document.createElement("br");
                let br2 = document.createElement("br");

                div.style.border = "solid 1px black";
                div.style.marginTop = "20px";
                div.style.padding = "10px";
                div.style.width = "300px";
    
                span.innerHTML = author;
                span2.innerHTML = content;
                span3.innerHTML = date;
                section.appendChild(div);
                div.appendChild(span);
                div.appendChild(br);
                div.appendChild(span2);
                div.appendChild(br2);
                div.appendChild(span3);
            })


        };
        api();

        formToDisplay.onsubmit = (e) => {
            e.preventDefault();
            fetch("/newComment", {
                method: "POST",
                body: new FormData(formToDisplay)
            }) .then(() => {
                api();
            })
        }
    };
});

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



