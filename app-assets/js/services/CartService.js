export class CartService {
  static getAll() {
    return axios.get(`/api.php/cart/list`);
  }

  static addToCart(productId, quantity = 1) {
    return axios
      .post(`/api.php/cart/add`, { product_id: productId, quantity })
      .then((res) => {
        Utils.showToastrSuccess("Product added to cart successfully!");
        return res;
      })
      .finally(() => {
        Utils.refetchCart();
      });
  }

  static removeFromCart(productId, quantity = -1) {
    return axios
      .post(`/api.php/cart/add`, { product_id: productId, quantity })
      .then((res) => {
        Utils.showToastrSuccess("Product has been removed from cart!");
        return res;
      })
      .finally(() => {
        Utils.refetchCart();
      });
  }

  static clearCart() {
    return axios.post(`/api.php/cart/clear_cart`, {}).finally(() => {
      Utils.refetchCart();
    });
  }
}
