const img = document.querySelector("#img");
const infoBox = document.querySelector("#info-box");
const content = document.querySelector("#content");
const body = document.querySelector("#body");

document.addEventListener("DOMContentLoaded", () => {
    body.classList.remove("hidden");

    gsap.fromTo(
        body,
        {
            opacity: 0,
            y: -200,
        },
        {
            duration: 0.5,
            opacity: 1,
            y: 0,
        }
    );
});

// 댓글

const commentButton = document.querySelector("#comment-button");
const commentBox = document.querySelector("#comment-box");

commentButton?.addEventListener("click", () => {
    commentBox.classList.toggle("hidden");

    gsap.fromTo(
        commentBox,
        {
            opacity: 0,
            y: -100,
        },
        {
            duration: 0.5,
            opacity: 1,
            y: 0,
        }
    );

    setTimeout(() => {
        window.scrollTo({
            top: document.body.scrollHeight,
            behavior: "smooth",
        });
    }, 1000);
});

const toLogin = document.querySelector("#to-login");

toLogin?.addEventListener("click", () => {
    gsap.to(body, {
        duration: 0.5,
        opacity: 0,
        y: 100,
    });

    setTimeout(() => {
        window.location.href = "/login";
    }, 500);
});

const editForm = document.querySelector("#edit-form");

editForm?.addEventListener("submit", (e) => {
    e.preventDefault();

    gsap.to(body, {
        duration: 0.5,
        opacity: 0,
        y: 100,
    });

    setTimeout(() => {
        editForm.submit();
    }, 500);
});

const editButtons = document.querySelectorAll("#edit-button");

editButtons?.forEach((item) => {
    item?.addEventListener("click", (event) => {
        const commentId = event.target.getAttribute("data-comment-id");
        const commentContent = document.querySelector(
            `#comment-content-${commentId}`
        );
        const editContent = document.querySelector(
            `#edit-content-${commentId}`
        );
        const editFormButton = document.querySelector(
            `#edit-form-buton-${commentId}`
        );

        commentContent.classList.toggle("hidden");
        editFormButton.classList.toggle("hidden");
        editContent.value = commentContent.innerText.trim();
    });
});
