window.onload = () => {
  const search = document.getElementById("search");
  const list = document.getElementById("articlelist");

  search.addEventListener("input", (e) => {
    const params = new URLSearchParams();
    const value = search.value;
    if (value) {
      params.append("filter", Boolean(value) ? value : "null");
      console.log(params.toString());
      const url = new URL(window.location.href);
      fetch(url.pathname + "?" + params.toString() + "&search=true", {
        headers: {
          "X-Requested-with": "XMLHttpRequest",
        },
      })
        .then((res) => res.json())
        .then((data) => (list.innerHTML = data.content))
        .catch((e) => alert(e));
    }
  });
};
