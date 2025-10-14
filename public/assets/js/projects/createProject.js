$(document).ready(function () {
  // Apply CSRF token globally
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });

  $(document).on("click", "#createProjectBtn", function (e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append("name", $("input[placeholder='Enter project name']").val());
    formData.append("description", $("textarea[placeholder='Describe the project...']").val());
    formData.append("color", $("input[type='color']").val());
    formData.append("status", $("select.form-select").val());
    formData.append("progress", $(".form-range").val());
    formData.append("start_date", $("input[placeholder='Select start date']").val());
    formData.append("end_date", $("input[placeholder='Select end date']").val());

    let selectedUsers = $("select[multiple]").val();
    if (selectedUsers) selectedUsers.forEach(u => formData.append("users[]", u));

    let thumbnail = $("input[type='file']")[0];
    if (thumbnail && thumbnail.files.length > 0) {
      formData.append("thumbnail", thumbnail.files[0]);
    }

    $.ajax({
      url: "/projects",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      beforeSend: function () {
        $("#createProjectBtn").text("Saving...").attr("disabled", true);
      },
      success: function (res) {
        if (res.success) {
          // inject success alert dynamically
          const alertHTML = `
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 3000)"
                 class="alert flex rounded-lg bg-success px-4 py-4 text-white sm:px-5 mt-4">
              ${res.message || "Project created successfully!"}
            </div>`;
          $("body").append(alertHTML);

          // reset form and modal
          setTimeout(() => {
            $(".alert.bg-success").fadeOut(500, function() { $(this).remove(); });
            location.reload();
          }, 2000);
        } else {
          const errorHTML = `
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 4000)"
                 class="alert flex rounded-lg bg-error px-4 py-4 text-white sm:px-5 mt-4">
              ${res.message || "Error creating project"}
            </div>`;
          $("body").append(errorHTML);
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
        const errorHTML = `
          <div x-data="{ show: true }"
               x-show="show"
               x-init="setTimeout(() => show = false, 4000)"
               class="alert flex rounded-lg bg-error px-4 py-4 text-white sm:px-5 mt-4">
            Something went wrong while saving the project.
          </div>`;
        $("body").append(errorHTML);
      },
      complete: function () {
        $("#createProjectBtn").text("Create").attr("disabled", false);
      }
    });
  });
});
