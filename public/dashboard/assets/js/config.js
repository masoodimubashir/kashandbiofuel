(function () {
  var primary = localStorage.getItem("primary") || "#678f44";
  var secondary = localStorage.getItem("secondary") || "#d1823f";

  window.KabulAdminConfig = {
    // Theme Primary Color
    primary: primary,
    // theme secondary color
    secondary: secondary,
  };
})();
