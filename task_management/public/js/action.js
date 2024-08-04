function add() {
    $.ajax({
        type: "GET",
        url: "/tasks/create",
        success: (response) => {
            $("#exampleModal").modal("show");
            $("#taskModal").html("Create a new task");
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
    $.ajax({
        type: "POST",
        url: "/tasks",
        data: new FormData(this),
        contentType: false,
        processData: false,
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

// Clear data in modal
$("#exampleModal").on("hidden.bs.modal", function () {
    $("#taskForm").trigger("reset");
    $("#taskForm").find(".print-error-msg").find("ul").html("");
    $("#taskForm").find(".print-error-msg").css("display", "none");
});
