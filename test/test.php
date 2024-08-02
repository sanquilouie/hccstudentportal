<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student List</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/esm/popper.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/esm/popper.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/esm/popper-utils.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/esm/popper-base.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Student List</h1>
        <table id="studentTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- Modify Student Modal -->
    <div class="modal fade" id="modifyStudentModal" tabindex="-1" role="dialog" aria-labelledby="modifyStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyStudentModalLabel">Modify Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="studentSelect" class="form-label">Select a student:</label>
                            <select id="studentSelect" class="form-control"></select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper-utils.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper-base.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Initialize the DataTable
        var table = $('#studentTable').DataTable({
            "ajax": {
                "url": "fetch_student_data.php",
                "dataSrc": ""
            },
            "columns": [
                { "data": "id" },
                { "data": "action" }
            ],
            "select": {
                "style": "single"
            }
        });

        // Initialize the Select2 dropdown
        $('#studentSelect').select2({
            ajax: {
                url: 'fetch_student_data.php',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for a student',
            minimumInputLength: 1,
            allowClear: true
        });

        // Modify button click event
        $('#studentTable tbody').on('click', 'button.modify', function () {
            var data = table.row($(this).parents('tr')).data();
            $('#modifyStudentModal').modal('show');
            $('#studentSelect').val(data.id).trigger('change');
        });

        // Save changes button click event
        $('#modifyStudentModal button.btn-primary').on('click', function () {
            var selectedStudent = $('#studentSelect').select2('data')[0];
            alert('You have modified student ' + selectedStudent.text);
            $('#modifyStudentModal').modal('hide');
        });
    });
</script>
</body>
</html>
