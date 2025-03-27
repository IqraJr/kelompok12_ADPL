document.addEventListener("DOMContentLoaded", function () {
    const categoryButtons = document.querySelectorAll(".category-btn");
    const productLists = document.querySelectorAll(".product-list");

    // Sembunyikan semua daftar produk saat pertama kali dibuka
    productLists.forEach(list => list.style.display = "none");

    categoryButtons.forEach(button => {
        button.addEventListener("click", function () {
            const categoryId = this.getAttribute("data-category");

            // Sembunyikan semua daftar produk terlebih dahulu
            productLists.forEach(list => list.style.display = "none");

            // Tampilkan hanya daftar produk yang sesuai dengan kategori yang diklik
            const selectedProductList = document.getElementById(`category-${categoryId}`);
            if (selectedProductList) {
                selectedProductList.style.display = "flex";
            }
        });
    });
});
