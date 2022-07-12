        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Posts</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Posts</li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- -------------------------------------------------------------- -->
        <!-- Container fluid  -->
        <!-- -------------------------------------------------------------- -->
        <div class="container-fluid note-has-grid">
            <ul class="nav nav-pills p-3 bg-white mb-3 align-items-center">
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center active px-3 px-md-3 me-0 me-md-2" id="all-category">
                        <i data-feather="list" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium">All Posts</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="note-announcement">
                        <i data-feather="briefcase" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium">Announcement</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="note-alerts">
                        <i data-feather="share-2" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium">Alerts</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center justify-content-center px-3 px-md-3 me-0 me-md-2" id="note-important">
                        <i data-feather="star" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium">Important</span></a>
                </li>
                <li class="nav-item ms-auto">
                    <a href="javascript:void(0)" class="nav-link btn-primary rounded-pill d-flex align-items-center px-3" id="add-notes">
                        <i data-feather="file" class="feather-sm fill-white me-0 me-md-1"></i><span class="d-none d-md-block font-weight-medium fs-3">Add Post</span></a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="note-full-container" class="note-has-grid row"></div>
            </div>

            <!-- Modal Add notes -->
            <div class="modal fade" id="addnotesmodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title text-white">Add Posts</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="notes-box">
                                <div class="notes-content">
                                    <form action="javascript:void(0);" id="addnotesmodalTitle">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="note-title">
                                                    <label>Title</label>
                                                    <input type="text" id="note-has-title" class="form-control" minlength="25" placeholder="Title" />
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="note-description">
                                                    <label>Description</label>
                                                    <textarea id="note-has-description" class="form-control" minlength="60" placeholder="Description" rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="note-category">
                                                    <label>Category</label>
                                                    <select id="note-has-category" class="form-select">
                                                        <option value=""> Please Select </option>
                                                        <option value="A"> Announcement </option>
                                                        <option value="I"> Important </option>
                                                    </select>
                                                    <div style="font-size: .875em;color: #fc4b6c;display:none;" id="category-error">Please select a category!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" data-bs-dismiss="modal">
                                Discard
                            </button>
                            <button id="btn-n-add" class="btn btn-info" disabled>
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function() {

                function showData() {
                    $.post("controller/ajax.php?q=Posts&m=show", {}, function(data, status) {
                        var res = JSON.parse(data);
                        var content = "";
                        if (res.data.length > 0) {
                            for (let pIndex = 0; pIndex < res.data.length; pIndex++) {
                                const pElem = res.data[pIndex];
                                var title = pElem.post_title;
                                var desc = pElem.post_content;
                                var date = pElem.post_date;
                                var category = pElem.category;
                                content += '<div class="col-md-4 single-note-item all-category ' + category + '">' +
                                    '<div class="card card-body">' +
                                    '<span class="side-stick"></span>' +
                                    '<h5 class="note-title text-truncate w-75 mb-0" data-noteHeading="' + title + '"> ' + title + ' <i class="point fas fa-circle ms-1 fs-1"></i>' +
                                    '</h5>' +
                                    '<p class="note-date fs-2 text-muted">' + date + '</p>' +
                                    '<div class="note-content">' +
                                    '<p class="note-inner-content text-muted" data-noteContent="' + desc + '">' + desc + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                            }
                        }
                        $("#note-full-container").html(content);
                    });
                }

                function removeNote() {
                    $(".remove-note")
                        .off("click")
                        .on("click", function(event) {
                            event.stopPropagation();
                            $(this).parents(".single-note-item").remove();
                        });
                }

                function favouriteNote() {
                    $(".favourite-note")
                        .off("click")
                        .on("click", function(event) {
                            event.stopPropagation();
                            $(this).parents(".single-note-item").toggleClass("note-favourite");
                        });
                }

                function addLabelGroups() {
                    $(".category-selector .badge-group-item")
                        .off("click")
                        .on("click", function(event) {
                            event.preventDefault();
                            /* Act on the event */
                            var getclass = this.className;
                            var getSplitclass = getclass.split(" ")[0];
                            if ($(this).hasClass("badge-announcement")) {
                                $(this).parents(".single-note-item").removeClass("note-announcement");
                                $(this).parents(".single-note-item").removeClass("note-important");
                                $(this).parents(".single-note-item").toggleClass(getSplitclass);
                            } else if ($(this).hasClass("badge-social")) {
                                $(this).parents(".single-note-item").removeClass("note-business");
                                $(this).parents(".single-note-item").removeClass("note-important");
                                $(this).parents(".single-note-item").toggleClass(getSplitclass);
                            } else if ($(this).hasClass("badge-important")) {
                                $(this).parents(".single-note-item").removeClass("note-announcement");
                                $(this).parents(".single-note-item").removeClass("note-business");
                                $(this).parents(".single-note-item").toggleClass(getSplitclass);
                            }
                        });
                }

                var $btns = $(".note-link").click(function() {
                    if (this.id == "all-category") {
                        var $el = $("." + this.id).fadeIn();
                        $("#note-full-container > div").not($el).hide();
                    }
                    if (this.id == "important") {
                        var $el = $("." + this.id).fadeIn();
                        $("#note-full-container > div").not($el).hide();
                    } else {
                        var $el = $("." + this.id).fadeIn();
                        $("#note-full-container > div").not($el).hide();
                    }
                    $btns.removeClass("active");
                    $(this).addClass("active");
                });

                $("#add-notes").on("click", function(event) {
                    $("#addnotesmodal").modal("show");
                    $("#btn-n-save").hide();
                    $("#btn-n-add").show();
                });

                // Button add
                $("#btn-n-add").on("click", function(event) {
                    event.preventDefault();
                    /* Act on the event */

                    var $_noteTitle = document.getElementById("note-has-title").value;
                    var $_noteDescription = document.getElementById("note-has-description").value;
                    var $_noteCategory = document.getElementById("note-has-category").value;

                    var $_noteCategoryError = document.getElementById("category-error");
                    if ($_noteCategory != "") {
                        $_noteCategoryError.style.display = "none";
                        $.post("controller/ajax.php?q=Posts&m=add", {
                            post_title: $_noteTitle,
                            post_content: $_noteDescription,
                            post_category: $_noteCategory,
                        }, function(data, status) {
                            $("#addnotesmodal").modal("hide");

                            showData();

                            removeNote();
                            favouriteNote();
                            addLabelGroups();
                        });
                    } else {
                        $_noteCategoryError.style.display = "block";
                    }
                });

                $("#addnotesmodal").on("hidden.bs.modal", function(event) {
                    event.preventDefault();
                    document.getElementById("note-has-title").value = "";
                    document.getElementById("note-has-description").value = "";
                    document.getElementById("note-has-category").value = "";
                    document.getElementById("category-error").style.display = "none";
                });

                showData();

                removeNote();
                favouriteNote();
                addLabelGroups();

                $("#btn-n-add").attr("disabled", "disabled");
            });

            $("#note-has-title").keyup(function() {
                var empty = false;
                $("#note-has-title").each(function() {
                    if ($(this).val() == "") {
                        empty = true;
                    }
                });

                if (empty) {
                    $("#btn-n-add").attr("disabled", "disabled");
                } else {
                    $("#btn-n-add").removeAttr("disabled");
                }
            });
        </script>