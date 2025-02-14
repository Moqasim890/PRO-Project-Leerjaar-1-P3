    $(document).ready(function () {
        loadClasses();
    });

    function loadClasses() {
        $.ajax({
            url: 'get_classes.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                let tableBody = $("#class-table-body");
                tableBody.empty();

                if (response.length === 0) {
                    tableBody.append('<tr><td colspan="5">No classes available.</td></tr>');
                } else {
                    response.forEach(classData => {
                        let row = `
                            <tr>
                                <td>${classData.Naam}</td>
                                <td>${classData.Datum}</td>
                                <td>${classData.Tijd}</td>
                                <td>${classData.Beschikbaarheid}</td>
                                <td>
                                    <button class="btn btn-success" onclick="bookClass(${classData.Id})">Book</button>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error loading classes:", error);
            }
        });
    }

    function bookClass(lessonId) {
        $.ajax({
            url: 'book_classes.php',
            method: 'POST',
            data: { lesson_id: lessonId },
            dataType: 'json',
            success: function (response) {
                alert(response.message);
                loadClasses(); // Refresh class list after booking
            },
            error: function (xhr, status, error) {
                console.error("Error booking class:", error);
            }
        });
    }