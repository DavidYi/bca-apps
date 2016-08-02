<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../shared/ss/main.css" rel="stylesheet" type="text/css" />
    <link href="/<?php echo $app_url_path ?>/../shared/roles/view.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" type="text/css" href="../combobox/jquery-easyui-1.5/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../combobox/jquery-easyui-1.5/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../combobox/jquery-easyui-1.5/demo.css">
    <script type="text/javascript" src="../combobox/jquery-easyui-1.5/jquery.min.js"></script>
    <script type="text/javascript" src="../combobox/jquery-easyui-1.5/jquery.easyui.min.js"></script>
</head>
<body>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="modify_admin">

    <div id="box">
        <div id="wrapper">
            <div id="wrapper2">
            <div id="columns">
                <h1 class="title">Admin Roles</h1>

                <div id="users">
                    <h2><strong>User</strong></h2>
                    <?php foreach($assigned_roles as $assigned_user) { ?>
                        <p class="user"><?php echo $assigned_user['usr_last_name'] ?>, <?php echo $assigned_user['usr_first_name'] ?></p>
                    <?php } ?>
                </div>

                <div id="se-wrap">
                    <div id="role">
                        <h2><strong>Role</strong></h2>
                        <?php foreach($assigned_roles as $assigned_user) { ?>
                            <p><?php echo $assigned_user['usr_role_desc'] ?></p>
                        <?php } ?>
                    </div>
                    <div id="delete">
                        <?php foreach($assigned_roles as $assigned_user) { ?>
                        <a href="index.php?action=delete_admin&usrID=<?php echo $assigned_user['usr_id'] ?>&roleID=<?php echo $assigned_user['usr_role_cde'] ?>"><h4 class="delete">d</h4></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div id="add">
                <br>
                <h2><strong>Add Admin</strong></h2>
<!--                <select id="user_drop" name="user_drop">-->
<!--                    --><?php //foreach($users as $user) { ?>
<!--                        <option value="--><?php //echo $user['usr_id'] ?><!--">--><?php //echo $user['usr_last_name'] ?><!--, --><?php //echo $user['usr_first_name'] ?><!--</option>-->
<!--                    --><?php //} ?>
<!--                </select>-->
                <div style="margin:20px 0"></div>
                <div class="easyui-panel" style="width:100%;max-width:400px;padding:30px 60px;">
                    <div style="margin-bottom:20px">
                        <select class="easyui-combobox" name="state" label="State:" labelPosition="top" style="width:100%;">
                            <?php foreach($users as $user) { ?>
                                <option value="<?php echo $user['usr_id'] ?>"><?php echo $user['usr_last_name'] ?>, <?php echo $user['usr_first_name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="ui-widget">
                    <select id="combobox2" name="role_drop" name="role_drop">
                        <option value="">Select one...</option>
                        <?php foreach($roles as $role) { ?>
                            <option value="<?php echo $role['usr_role_cde'] ?>"><?php echo $role['usr_role_desc'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <br>
                <button class="submit s" type="submit" name="choice" value="Add Admin">Add</button>
                <button class="submit back" type="submit" name="choice" value="Back">Back</button>
            </div>
        </div>
            </div>
    </div>
</form>
</body>

<script>
    $(function() {
        $.widget("custom.combobox", {
            _create: function() {
                this.wrapper = $("<span>")
                    .addClass("custom-combobox")
                    .insertAfter(this.element);

                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children(":selected"),
                    value = selected.val() ? selected.text() : "";

                this.input = $("<input>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .attr("title", "")
                    .addClass("custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left")
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        classes: {
                            "ui-tooltip": "ui-state-highlight"
                        }
                    });

                this._on(this.input, {
                    autocompleteselect: function(event, ui) {
                        ui.item.option.selected = true;
                        this._trigger("select", event, {
                            item: ui.item.option
                        });
                    },

                    autocompletechange: "_removeIfInvalid"
                });
            },

            _createShowAllButton: function() {
                var input = this.input,
                    wasOpen = false;

                $("<a>")
                    .attr("tabIndex", -1)
                    .tooltip()
                    .appendTo(this.wrapper)
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass("ui-corner-all")
                    .addClass("custom-combobox-toggle ui-corner-right")
                    .on("mousedown", function() {
                        wasOpen = input.autocomplete("widget").is(":visible");
                    })
                    .on("click", function() {
                        input.trigger("focus");

                        // Close if already visible
                        if (wasOpen) {
                            return;
                        }

                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete("search", "");
                    });
            },

            _source: function(request, response) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response(this.element.children("option").map(function() {
                    var text = $(this).text();
                    if (this.value && (!request.term || matcher.test(text)))
                        return {
                            label: text,
                            value: text,
                            option: this
                        };
                }));
            },

            _removeIfInvalid: function(event, ui) {

                // Selected an item, nothing to do
                if (ui.item) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children("option").each(function() {
                    if ($(this).text().toLowerCase() === valueLowerCase) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if (valid) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val("")
                    .tooltip("open");
                this.element.val("");
                this._delay(function() {
                    this.input.tooltip("close").attr("title", "");
                }, 2500);
                this.input.autocomplete("instance").term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });

        $("#combobox").combobox();
        $("#toggle").on("click", function() {
            $("#combobox").toggle();
        });
    });
    $(function() {
        $.widget("custom.combobox2", {
            _create: function() {
                this.wrapper = $("<span>")
                    .addClass("custom-combobox2")
                    .insertAfter(this.element);

                this.element.hide();
                this._createAutocomplete();
                this._createShowAllButton();
            },

            _createAutocomplete: function() {
                var selected = this.element.children(":selected"),
                    value = selected.val() ? selected.text() : "";

                this.input = $("<input>")
                    .appendTo(this.wrapper)
                    .val(value)
                    .attr("title", "")
                    .addClass("custom-combobox2-input ui-widget ui-widget-content ui-state-default ui-corner-left")
                    .autocomplete({
                        delay: 0,
                        minLength: 0,
                        source: $.proxy(this, "_source")
                    })
                    .tooltip({
                        classes: {
                            "ui-tooltip": "ui-state-highlight"
                        }
                    });

                this._on(this.input, {
                    autocompleteselect: function(event, ui) {
                        ui.item.option.selected = true;
                        this._trigger("select", event, {
                            item: ui.item.option
                        });
                    },

                    autocompletechange: "_removeIfInvalid"
                });
            },

            _createShowAllButton: function() {
                var input = this.input,
                    wasOpen = false;

                $("<a>")
                    .attr("tabIndex", -1)
                    .tooltip()
                    .appendTo(this.wrapper)
                    .button({
                        icons: {
                            primary: "ui-icon-triangle-1-s"
                        },
                        text: false
                    })
                    .removeClass("ui-corner-all")
                    .addClass("custom-combobox2-toggle ui-corner-right")
                    .on("mousedown", function() {
                        wasOpen = input.autocomplete("widget").is(":visible");
                    })
                    .on("click", function() {
                        input.trigger("focus");

                        // Close if already visible
                        if (wasOpen) {
                            return;
                        }

                        // Pass empty string as value to search for, displaying all results
                        input.autocomplete("search", "");
                    });
            },

            _source: function(request, response) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
                response(this.element.children("option").map(function() {
                    var text = $(this).text();
                    if (this.value && (!request.term || matcher.test(text)))
                        return {
                            label: text,
                            value: text,
                            option: this
                        };
                }));
            },

            _removeIfInvalid: function(event, ui) {

                // Selected an item, nothing to do
                if (ui.item) {
                    return;
                }

                // Search for a match (case-insensitive)
                var value = this.input.val(),
                    valueLowerCase = value.toLowerCase(),
                    valid = false;
                this.element.children("option").each(function() {
                    if ($(this).text().toLowerCase() === valueLowerCase) {
                        this.selected = valid = true;
                        return false;
                    }
                });

                // Found a match, nothing to do
                if (valid) {
                    return;
                }

                // Remove invalid value
                this.input
                    .val("")
                    .tooltip("open");
                this.element.val("");
                this._delay(function() {
                    this.input.tooltip("close").attr("title", "");
                }, 2500);
                this.input.autocomplete("instance").term = "";
            },

            _destroy: function() {
                this.wrapper.remove();
                this.element.show();
            }
        });

        $("#combobox").combobox();
        $("#toggle").on("click", function() {
            $("#combobox").toggle();
        });
    });
</script>

</html>
