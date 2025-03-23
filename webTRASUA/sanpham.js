var cart = [];
function toggleItems(type) {
  const section = document.querySelector(`#${type}`);
  const hiddenItems = section.querySelectorAll(".product-gallery .item.hidden");
  const button = section.querySelector(".show-more");

  if (hiddenItems.length > 0) {
    hiddenItems.forEach((item) => {
      item.style.display = "block";
      item.classList.remove("hidden");
      item.dataset.isHidden = "false";
    });
    button.innerText = "Ẩn Bớt";
  } else {
    const allItems = section.querySelectorAll(".product-gallery .item");
    allItems.forEach((item, index) => {
      if (index >= 4) {
        item.style.display = "none";
        item.classList.add("hidden");
        item.dataset.isHidden = "true";
      }
    });
    button.innerText = "Xem Tất Cả";
  }
}

const allItems = document.querySelectorAll(".product-gallery .item");
allItems.forEach((item) => {
  const productID = item.querySelector(".openModalImg").dataset.productId;
  const isHidden = item.dataset.isHidden === "true";
  const isInCart = cart.some((cartItem) => cartItem.productID === productID);

  if (isHidden && !isInCart && removedProduct.productID === productID) {
    // Nếu sản phẩm đã bị ẩn, không còn trong giỏ hàng và là sản phẩm vừa bị xóa
    item.style.display = "block";
    item.classList.remove("hidden");
    item.dataset.isHidden = "false";
  }
});

function openCartModal() {
  document.getElementById("cartModal").style.display = "block";
}

function closeCartModal() {
  document.getElementById("cartModal").style.display = "none";
}

window.addEventListener("click", function (event) {
  if (event.target == document.getElementById("cartModal")) {
    closeCartModal();
  }
});

let backToTopBtn = document.getElementById("backToTopBtn");

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    backToTopBtn.style.display = "block";
  } else {
    backToTopBtn.style.display = "none";
  }
}

function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

function toggleLogoutMenu() {
  var menu = document.getElementById("logoutMenu");
  if (menu.style.display === "block") {
    menu.style.display = "none";
  } else {
    menu.style.display = "block";
  }
}

window.addEventListener("click", function (event) {
  var menu = document.getElementById("logoutMenu");
  if (!event.target.matches(".account-icon")) {
    if (menu.style.display === "block") {
      menu.style.display = "none";
    }
  }
});

document.addEventListener("DOMContentLoaded", function () {
  var modal = document.getElementById("productModal");
  var span = document.getElementsByClassName("close")[0];
  var modalImg = document.getElementById("modalProductImage");
  var modalName = document.getElementById("modalProductName");
  var modalPrice = document.getElementById("modalProductPrice");
  var addToCartBtn = document.getElementById("addToCartBtn");

  function openModal(imgSrc, name, price, originalPrice, productID) {
    modalImg.src = imgSrc;
    modalName.innerText = name;
    modalImg.dataset.productID = productID;
    modalPrice.innerText = "Price: " + price + "d";
    modalImg.dataset.originalPrice = originalPrice; // Lưu trữ giá gốc
    modal.style.display = "block";

    // Cập nhật giá khi mở modal (mặc định là giá gốc)
    updatePrice();
  }

  var images = document.getElementsByClassName("openModalImg");
  for (var i = 0; i < images.length; i++) {
    images[i].onclick = function () {
      var imgSrc = this.src;
      var name = this.getAttribute("data-name");
      var price = parseFloat(this.getAttribute("data-price"));
      var originalPrice = parseFloat(this.getAttribute("data-original-price"));
      var productID = this.getAttribute("data-product-id");
      openModal(imgSrc, name, price, originalPrice, productID);
    };
  }

  span.addEventListener("click", function () {
    modal.style.display = "none";
    document.getElementById("productForm").reset();
  });

  window.addEventListener("click", function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

  loadCartFromLocalStorage();

  addToCartBtn.onclick = function () {
    var selectedSize = document.querySelector('input[name="size"]:checked');
    var productID = modalImg.dataset.productID;

    if (selectedSize) {
      var existingItemIndex = cart.findIndex(
        (item) =>
          item.productID === productID && item.size === selectedSize.value
      );

      if (existingItemIndex !== -1) {
        // Sản phẩm đã có trong giỏ hàng
        cart[existingItemIndex].quantity += 1;
      } else {
        // Sản phẩm chưa có trong giỏ hàng
        var item = {
          name: modalName.innerText,
          productID: productID,
          price: parseFloat(
            modalPrice.innerText.replace("Price: ", "").replace("d", "").trim()
          ),
          size: selectedSize.value,
          img: modalImg.src,
          quantity: 1,
        };
        cart.push(item);
      }
      updateCart();
      saveCartToLocalStorage();
      modal.style.display = "none";
      document.getElementById("productForm").reset();
    } else {
      alert("Vui lòng chọn size trước khi thêm vào giỏ hàng.");
    }
  };

  function updateCart() {
    var cartModal = document.getElementById("cartModal");
    var cartContent = cartModal.querySelector(".modal-content1 p");
    var cartBadge = document.getElementById("cartBadge");
    cartContent.innerHTML = "";

    if (cart.length === 0) {
      cartContent.innerHTML =
        "Giỏ hàng trống. Bạn hãy chọn món mình thích nhé ❤️";
      cartBadge.style.display = "none"; // Ẩn dấu * khi giỏ hàng trống
    } else {
      cartBadge.style.display = "block";
      cartBadge.innerText = cart.length;
      let totalPrice = 0;
      cart.forEach(function (item, index) {
        totalPrice += item.price * item.quantity;
        cartContent.innerHTML += `
                    <div class="cart-item">
                        <img src="${item.img}" alt="${item.name}" style="width: 100px">
                        <p>${item.name} - Size: ${item.size} - ${item.price}d</p>
                        <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)">
                        <button onclick="removeItem(${index})">Xóa</button> 
                    </div>
                `;
      });

      const totalElement = document.createElement("div");
      totalElement.textContent = `Tổng tiền: ${totalPrice}d`;
      cartContent.appendChild(totalElement);
    }

    // Lắng nghe sự kiện 'change' trên các input số lượng
    const quantityInputs = cartContent.querySelectorAll('input[type="number"]');
    quantityInputs.forEach((input, index) => {
      input.addEventListener("change", () => {
        updateQuantity(index, input.value); // Cập nhật số lượng trong mảng cart
        updateTotalPrice(); // Cập nhật tổng tiền trực tiếp trong modal
      });
    });
  }

  function updateTotalPrice() {
    const cartContent = document
      .getElementById("cartModal")
      .querySelector(".modal-content1 p");
    let totalPrice = 0;
    cart.forEach((item) => {
      totalPrice += item.price * item.quantity;
    });

    // Tìm phần tử hiển thị tổng tiền và cập nhật giá trị
    const totalElement = cartContent.querySelector("div:last-child");
    if (totalElement) {
      totalElement.textContent = `Tổng tiền: ${totalPrice}d`;
    }
  }

  function saveCartToLocalStorage() {
    localStorage.setItem("cart", JSON.stringify(cart));
  }

  function loadCartFromLocalStorage() {
    const storedCart = localStorage.getItem("cart");

    if (storedCart) {
      cart = JSON.parse(storedCart);
      updateCart();
    }
  }


  window.removeItem = function (index) {
    const removedProduct = cart[index];
    cart.splice(index, 1);
    updateCart();
    saveCartToLocalStorage();
  };

  window.updateQuantity = function (index, quantity) {
    cart[index].quantity = parseInt(quantity);
    saveCartToLocalStorage();
  };

  window.updateQuantity = function (index, quantity) {
    cart[index].quantity = parseInt(quantity);
  };

  document
    .querySelector(".cart-icon img")
    .addEventListener("click", function () {
      document.getElementById("cartModal").style.display = "block";
    });

  document
    .getElementsByClassName("close")[1]
    .addEventListener("click", function () {
      document.getElementById("cartModal").style.display = "none";
    });

  // Lắng nghe sự kiện 'change' trên các nút radio
  const sizeRadios = document.querySelectorAll('input[name="size"]');
  sizeRadios.forEach((radio) => {
    radio.addEventListener("change", updatePrice);
  });

  function updatePrice() {
    const modalProductPrice = document.getElementById("modalProductPrice");
    const originalPrice = parseFloat(
      document.getElementById("modalProductImage").dataset.originalPrice
    );

    if (this.value === "M") {
      modalProductPrice.textContent = "Price: " + (originalPrice - 5000) + "d";
    } else {
      // Size L hoặc không có lựa chọn
      modalProductPrice.textContent = "Price: " + originalPrice + "d";
    }
  }


window.placeOrder = function() {
    if (!isLoggedIn) {
        alert("Bạn cần đăng nhập để thanh toán!");
        window.location.href = "dangnhap.php";
        return;
    }

    if (cart.length === 0) {
        alert("Vui lòng chọn sản phẩm trước khi thanh toán!");
        return;
    }

    var total = cart.reduce(function(sum, item) {
        return sum + item.price * item.quantity;
    }, 0);

    var confirmation = confirm("Tổng giá tiền: " + total + "d. Bạn có chắc chắn muốn thanh toán không?");
    
    if (confirmation) {
        cart = [];
        updateCart();
        saveCartToLocalStorage();
        window.location.href = "thanhtoan.php";
    }
};
});
