document.addEventListener("DOMContentLoaded", function () {
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateY(-20px)";
        }, 3000);
    }
});
