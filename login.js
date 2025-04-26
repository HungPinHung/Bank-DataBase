
let currentRole = "User";

function switchPermission(element) {
    document.querySelectorAll('.permission_option').forEach(btn => btn.classList.remove("selected"));
    element.classList.add("selected");
    currentRole = element.getAttribute("data-role");
}

function handleLogin() {
    const usernameInput = document.getElementById("username").value.trim();
    const passwordInput = document.getElementById("password").value.trim();

    const credentials = {
        User: { username: "user", password: "user123" },
        Service: { username: "staff", password: "staff123" }
    };

    const valid = credentials[currentRole];

    if (usernameInput === valid.username && passwordInput === valid.password) {
        alert(currentRole + " 登入成功！");
        window.location.href = "index.html";
    } else {
        alert("帳號或密碼錯誤，請重試。");
    }
}
