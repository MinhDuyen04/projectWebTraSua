// JavaScript để hiển thị và ẩn menu đăng xuất khi nhấp vào biểu tượng tài khoản
function toggleLogoutMenu() {
    var logoutMenu = document.getElementById('logoutMenu');
    if (logoutMenu.style.display === 'block') {
        logoutMenu.style.display = 'none';
    } else {
        logoutMenu.style.display = 'block';
    }
}

// Đảm bảo menu đăng xuất bị ẩn khi nhấp ra ngoài
document.addEventListener('click', function (event) {
    var logoutMenu = document.getElementById('logoutMenu');
    if (!logoutMenu.contains(event.target) && event.target.className !== 'account-icon') {
        logoutMenu.style.display = 'none';
    }
});
