document.getElementById("reviewForm")?.addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData();
  formData.append("product_id", document.getElementById("product_id").value);
  formData.append("rating", document.getElementById("rating").value);
  formData.append("comment", document.getElementById("comment").value);

  fetch("review_add_ajax.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        const reviewsList = document.getElementById("reviewsList");

        const div = document.createElement("div");
        div.classList.add("review");
        div.innerHTML = `
            <strong>${data.username}</strong>
            – Rating: ${data.rating}/5<br>
            <small>${data.created_at}</small>
            <p>${data.comment}</p>
            <hr>
          `;

        reviewsList.prepend(div);
        document.getElementById("reviewForm").reset();
      }
    });
});
