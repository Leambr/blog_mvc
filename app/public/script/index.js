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
        isVisible = !isVisible;
        formToDisplay.style.display = isVisible ? "block" : "none";
        e.target.innerHTML = isVisible ? "Annuler" : "Commentaires";
        let postId = formToDisplay.elements[1].value;
        const api = async () => {
            const res = await fetch(`/comment/${postId}`);
            const data = await res.json();
            console.table(data);
        };
        api();

        formToDisplay.onsubmit = (e) => {
            e.preventDefault();
            console.log(formToDisplay);
            fetch("/newComment", {
                method: "POST",
                body: new FormData(formToDisplay)
            }) .then(() => {
                api();
                formToDisplay.elements[0].value = "";
            })
        }
    };
});



