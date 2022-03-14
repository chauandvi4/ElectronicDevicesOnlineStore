const toastrConfig = {
  positionClass: "toast-top-left",
  closeButton: true,
  tapToDismiss: true,
  timeOut: 2000,
};

const SHIPPING_SERVICE = {
  53319: "Nhanh",
  53320: "Chuẩn",
  53321: "Tiết kiệm",
  53330: "Chậm",
};

const Utils = {
  showToastrSuccess(message = "", title = "Success!") {
    toastr["success"](message, title, toastrConfig);
  },
  showToastrError(message = "", title = "Error!") {
    toastr["error"](message, title, toastrConfig);
  },
  delayNavigate(url, delay = 2000) {
    setTimeout(() => {
      window.location.replace(url);
    }, delay);
  },
  formatPrice(num) {
    return new Intl.NumberFormat("vi-VI", {
      style: "currency",
      currency: "VND",
    }).format(num);
  },
  refetchCart() {
    if (document.vueHeader) {
      document.vueHeader.$emit("refetch_cart", null);
    }
    if (document.vueCheckout) {
      document.vueCheckout.$emit("refetch_cart", null);
    }
  },

  refetchWishlist() {
    if (document.vueHeader) {
      document.vueHeader.$emit("refetch_wishlist", null);
    }
    if (document.vueProductList) {
      document.vueProductList.$emit("refetch_wishlist", null);
    }
    if (document.vueWishlist) {
      document.vueWishlist.$emit("refetch_wishlist", null);
    }
  },

  getToken() {
    if (!JWT_TOKEN) {
      JWT_TOKEN = localStorage.getItem("token");
    }

    return JWT_TOKEN;
  },

  setToken(token) {
    localStorage.setItem("token", token);

    JWT_TOKEN = token;
  },
  parseJwt(token) {
    if (!token) return null;

    var base64Url = token.split(".")[1];
    var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
    var jsonPayload = decodeURIComponent(
      atob(base64)
        .split("")
        .map(function (c) {
          return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
        })
        .join("")
    );

    return JSON.parse(jsonPayload);
  },
  roundToTwo(num) {
    return +(Math.round(num + "e+2") + "e-2");
  },
};

// START: Axios interceptors
axios.interceptors.request.use(function (config) {
  if (JWT_TOKEN) {
    config.headers.Authorization = "Bearer " + JWT_TOKEN;
  }

  return config;
});

axios.interceptors.response.use(
  function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
  },
  function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    if (error.response?.status == 401) {
      window.location.href = "/not-authorized.php";
    } else if (error.response?.data?.error) {
      Utils.showToastrError(error.response?.data?.error);
    }

    return Promise.reject(error);
  }
);
// END: Axios interceptors

// do something on init
var JWT_TOKEN = Utils.getToken();
var TOKEN_DATA = null;

if (JWT_TOKEN) {
  TOKEN_DATA = Utils.parseJwt(JWT_TOKEN);
  const currentTime = Math.round(new Date().getTime() / 1000);
  // Check if token is expired
  if (currentTime - TOKEN_DATA.exp > 0) {
    Utils.setToken("");
    window.location.href = "/";
  }
}

var __USER__ = TOKEN_DATA?.data;
