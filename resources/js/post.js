const body = document.querySelector("#body");

document.addEventListener("DOMContentLoaded", function () {
    const editor = document.querySelector("#editor");
    const quill = new Quill(editor, {
        theme: "snow",
        modules: {},
    });

    document.querySelector("#editor-content").value = quill.root.innerHTML;

    quill.on("text-change", function () {
        document.querySelector("#editor-content").value = quill.root.innerHTML;
    });

    body.classList.remove("hidden");

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
