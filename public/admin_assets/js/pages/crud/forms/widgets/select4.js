// Class definition
var KTselect4 = function() {
    // Private functions
    var demos = function() {
        // basic
        $('#kt_select4_1, #kt_select4_1_validate').select4({
            placeholder: "Select a state"
        });

        // nested
        $('#kt_select4_2, #kt_select4_2_validate').select4({
            placeholder: "Select a state"
        });

        // multi select
        $('#kt_select4_3, #kt_select4_3_validate').select4({
            placeholder: "Select a state",
        });

        // basic
        $('#kt_select4_4').select4({
            placeholder: "Select a state",
            allowClear: true
        });

        // loading data from array
        var data = [{
            id: 0,
            text: 'Enhancement'
        }, {
            id: 1,
            text: 'Bug'
        }, {
            id: 2,
            text: 'Duplicate'
        }, {
            id: 3,
            text: 'Invalid'
        }, {
            id: 4,
            text: 'Wontfix'
        }];

        $('#kt_select4_5').select4({
            placeholder: "Select a value",
            data: data
        });

        // loading remote data

        function formatRepo(repo) {
            if (repo.loading) return repo.text;
            var markup = "<div class='select4-result-repository clearfix'>" +
                "<div class='select4-result-repository__meta'>" +
                "<div class='select4-result-repository__title'>" + repo.full_name + "</div>";
            if (repo.description) {
                markup += "<div class='select4-result-repository__description'>" + repo.description + "</div>";
            }
            markup += "<div class='select4-result-repository__statistics'>" +
                "<div class='select4-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" +
                "<div class='select4-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" +
                "<div class='select4-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" +
                "</div>" +
                "</div></div>";
            return markup;
        }

        function formatRepoSelection(repo) {
            return repo.full_name || repo.text;
        }

        $("#kt_select4_6").select4({
            placeholder: "Search for git repositories",
            allowClear: true,
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by select4
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        // custom styles

        // tagging support
        $('#kt_select4_12_1, #kt_select4_12_2, #kt_select4_12_3, #kt_select4_12_4').select4({
            placeholder: "Select an option",
        });

        // disabled mode
        $('#kt_select4_7').select4({
            placeholder: "Select an option"
        });

        // disabled results
        $('#kt_select4_8').select4({
            placeholder: "Select an option"
        });

        // limiting the number of selections
        $('#kt_select4_9').select4({
            placeholder: "Select an option",
            maximumSelectionLength: 2
        });

        // hiding the search box
        $('#kt_select4_10').select4({
            placeholder: "Select an option",
            minimumResultsForSearch: Infinity
        });

        // tagging support
        $('#kt_select4_11').select4({
            placeholder: "Add a tag",
            tags: true
        });

        // disabled results
        $('.kt-select4-general').select4({
            placeholder: "Select an option"
        });
    }

    var modalDemos = function() {
        $('#kt_select4_modal').on('shown.bs.modal', function () {
            // basic
            $('#kt_select4_1_modal').select4({
                placeholder: "Select a state"
            });

            // nested
            $('#kt_select4_2_modal').select4({
                placeholder: "Select a state"
            });

            // multi select
            $('#kt_select4_3_modal').select4({
                placeholder: "Select a state",
            });

            // basic
            $('#kt_select4_4_modal').select4({
                placeholder: "Select a state",
                allowClear: true
            });
        });
    }

    // Public functions
    return {
        init: function() {
            demos();
            modalDemos();
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    KTselect4.init();
});
