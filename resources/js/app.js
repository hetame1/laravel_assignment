import "./bootstrap";

const boxes = document.querySelectorAll("#box");
const body = document.querySelector("#body");

boxes?.forEach((box) => {
    let isClicked = false;

    box.addEventListener("mouseover", (event) => {
        if (!isClicked) {
            gsap.to(event.currentTarget, {
                duration: 0.5,
                scale: 1.1,
                rotate: 5,
                backgroundColor: "#000",
                color: "#fff",
                borderRadius: "5%",
            });
        }
    });

    box.addEventListener("mouseout", (event) => {
        if (!isClicked) {
            gsap.to(event.currentTarget, {
                duration: 0.5,
                scale: 1,
                rotate: 0,
                backgroundColor: "#fff",
                color: "#000",
                borderRadius: "0%",
            });
        }
    });

    box.addEventListener("click", (event) => {
        isClicked = true;

        gsap.to(body, {
            duration: 0.5,
            opacity: 0,
            rotate: 0,
            y: 100,
        });

        const postId = event.currentTarget.getAttribute("data-post-id");

        setTimeout(() => {
            window.location.href = `/posts/${postId}`;
        }, 500);
    });
});

document.addEventListener("DOMContentLoaded", () => {
    body?.classList.remove("hidden");

    gsap.fromTo(
        body,
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
});

const writePage = document.querySelector("#write-page");
const homePage = document.querySelector("#home-page");
const mainPage = document.querySelector("#main-page");
const profilePage = document.querySelector("#profile-page");

mainPage?.addEventListener("click", () => {
    gsap.to(body, {
        duration: 0.5,
        opacity: 0,
        y: 100,
    });

    setTimeout(() => {
        window.location.href = "/";
    }, 500);
});

homePage?.addEventListener("click", () => {
    gsap.to(body, {
        duration: 0.5,
        opacity: 0,
        y: 100,
    });

    setTimeout(() => {
        window.location.href = "/";
    }, 500);
});

writePage?.addEventListener("click", () => {
    gsap.to(body, {
        duration: 0.5,
        opacity: 0,
        y: 100,
    });

    setTimeout(() => {
        window.location.href = "/posts/write";
    }, 500);
});

profilePage?.addEventListener("click", () => {
    gsap.to(body, {
        duration: 0.5,
        opacity: 0,
        y: 100,
    });

    setTimeout(() => {
        window.location.href = "/user/profile";
    }, 500);
});
