//Ẩn hiện sản phẩm
function toggleVisibility(productID, currentState) {
    console.log('toggleVisibility called for productID:', productID, 'currentState:', currentState);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "toggleVisibility.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            console.log('XHR readyState:', xhr.readyState, 'status:', xhr.status);

            if (xhr.status === 200) {
                console.log('XHR response:', xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    const button = document.getElementById("toggleButton_" + productID);

                    if (currentState === 1) {
                        button.textContent = 'Hiện sản phẩm';
                        button.setAttribute('onclick', 'toggleVisibility(' + productID + ', 0)');
                        alert('Sản phẩm đã được ẩn thành công');
                    } else {
                        button.textContent = 'Ẩn sản phẩm';
                        button.setAttribute('onclick', 'toggleVisibility(' + productID + ', 1)');
                        alert('Sản phẩm đã được hiện thành công');
                    }
                } else {
                    alert('Có lỗi xảy ra: ' + response.message);
                }
            } else {
                console.error('XHR error:', xhr.status, xhr.statusText);
                alert('Có lỗi xảy ra khi gửi yêu cầu đến máy chủ.');
            }
        }
    };

    xhr.onerror = function() {
        console.error('XHR request failed.');
        alert('Không thể kết nối đến máy chủ.');
    };

    console.log('Sending request with productID:', productID, 'currentState:', currentState);
    xhr.send("id=" + productID + "&currentState=" + currentState);
}




//Sửa sản phẩm

function openEditProductModal(productID, productName, price, status) {
    document.getElementById('editProductID').value = productID;
    document.getElementById('editProductName').value = productName;
    document.getElementById('editProductPrice').value = price;
    document.getElementById('editProductStatus').value = status;

    document.getElementById('editProductModal').style.display = 'block';
}

function closeEditProductModal() {
    document.getElementById('editProductModal').style.display = 'none';
}

function saveProductChanges() {
    var productID = document.getElementById('editProductID').value;
    var price = document.getElementById('editProductPrice').value;
    var status = document.getElementById('editProductStatus').value;

    // Gửi AJAX request để cập nhật sản phẩm
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "editProduct.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert('Sản phẩm đã được cập nhật');
            location.reload(); // Reload trang sau khi cập nhật
        }
    };

    xhr.send("id=" + productID + "&price=" + price + "&status=" + status);
}
