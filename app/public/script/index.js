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
            console.table(data);

            data.forEach(comment => {
                let content = comment.content;
                let author = comment.author;
                let div = document.createElement("div");
                let span = document.createElement("span");
                let span2 = document.createElement("span");
                let br = document.createElement("br");
    
                div.style.border = "solid 1px black";
                div.style.marginTop = "20px";
                div.style.padding = "10px";
                div.style.width = "300px";
    
                span.innerHTML = author;
                span2.innerHTML = content;
                section.appendChild(div);
                div.appendChild(span);
                div.appendChild(br);
                div.appendChild(span2);
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



