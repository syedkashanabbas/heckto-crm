$(document).ready(function () {
  // Apply CSRF token globally (just in case)
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });

  // Listen for "Create" button click
  $(document).on("click", "#createProjectBtn", function (e) {
    e.preventDefault();

    // Collect form data
    let formData = new FormData();
    formData.append("name", $("input[placeholder='Enter project name']").val());
    formData.append("description", $("textarea[placeholder='Describe the project...']").val());
    formData.append("color", $("input[type='color']").val());
    formData.append("status", $("select.form-select").val());
    formData.append("progress", $(".form-range").val());
    formData.append("start_date", $("input[placeholder='Select start date']").val());
    formData.append("end_date", $("input[placeholder='Select end date']").val());

    // Multi-select users
    let selectedUsers = $("select[multiple]").val();
    if (selectedUsers) {
      selectedUsers.forEach(u => formData.append("users[]", u));
    }

    // Thumbnail upload
    let thumbnail = $("input[type='file']")[0];
    if (thumbnail && thumbnail.files.length > 0) {
      formData.append("thumbnail", thumbnail.files[0]);
    }

    // Send to backend
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
          alert("Project created successfully!");
          location.reload();
        } else {
          alert(res.message || "Error creating project");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
        alert("Something went wrong while saving the project.");
      },
      complete: function () {
        $("#createProjectBtn").text("Create").attr("disabled", false);
      }
    });
  });


});


