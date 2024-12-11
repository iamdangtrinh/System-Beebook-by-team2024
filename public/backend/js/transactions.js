$(document).ready(function () {
    flatpickr("#start_date", {
        dateFormat: "d-m-Y", // Ensure this matches your expected format
    });
    flatpickr("#end_date", {
        dateFormat: "d-m-Y",
    });
});
