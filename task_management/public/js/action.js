function add() {
    $.ajax({
        type: "GET",
        url: "/tasks/create",
        success: (response) => {
            $("#exampleModal").modal("show");
            $("#taskModal").html("Create a new task");
            $("#taskForm").trigger("reset");
        },
        error: function (response) {
            if (response.status === 403) {
                logError();
            } else if (response.status === 401) {
                window.location.href = "/login";
            }
        },
    });
}

// Process task
$("#taskForm").submit(function (event) {
    event.preventDefault();
    const taskId = $("#task_id").val();
    const url = !taskId ? "/tasks" : "/tasks/" + taskId;
    const formData = !taskId ? new FormData(this) : $(this).serialize();
    const method = !taskId ? "POST" : "PUT";
    const contentType = !taskId ? false : undefined;
    const processData = !taskId ? false : undefined;
    $.ajax({
        type: method,
        url: url,
        data: formData,
        contentType: contentType,
        processData: processData,
        success: (response) => {
            location.reload();
        },
        error: function (response) {
            if (response.status === 403) {
                logError();
            } else if (response.status === 401) {
                window.location.href = "/login";
            } else {
                $("#taskForm").find(".print-error-msg").find("ul").html("");
                $("#taskForm").find(".print-error-msg").css("display", "block");
                $.each(response.responseJSON.errors, function (key, value) {
                    $("#taskForm")
                        .find(".print-error-msg")
                        .find("ul")
                        .append("<li>" + value + "</br>" + "</li>");
                });
            }
        },
    });
});

// Edit task form
function editFunc(id) {
    $.ajax({
        type: "GET",
        url: "/tasks/" + id + "/edit",
        success: (response) => {
            $("#exampleModal").modal("show");
            $("#taskModal").html("Update task details");
            $("#task_id").val(response[0].id);
            $("#task_name").val(response[0].name);
            $("#task_content").val(response[0].content);
        },
        error: function (response) {
            if (response.status === 403) {
                logError();
            } else if (response.status === 401) {
                window.location.href = "/login";
            }
        },
    });
}

// Clear data in modal
$("#exampleModal").on("hidden.bs.modal", function () {
    $("#taskForm").trigger("reset");
    $("#taskForm").find(".print-error-msg").find("ul").html("");
    $("#taskForm").find(".print-error-msg").css("display", "none");
});
