function hideRestrictedElements() {
    $.ajax("./api/getPermissions.php", {
        async: false,
        data: "",
        success: function(data)
        {
            if(data == "none") {
                $("#edit").hide();
                return;
            }
            
            var permissions = JSON.parse(data);
            
            if(permissions.write != 1) {
                $("#edit").hide();
            }
        },
        error: function(a, b, c)
        {
            console.log(a + ", " + b + ", " + c);
        }
    })
}

function getParameter(urlQuery) {
    urlQuery = urlQuery.split("+").join(" ");

    var params = {};
    var tokens;
    var regex = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = regex.exec(urlQuery)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
    }

    return params;
}

function drawCustomerStructure(customerData) {
    var json = JSON.parse(customerData);

    $("#customerID").html(json.customerId);
    $("#customerTaxID").html(json.customerTaxId);
    $("#companyName").html(json.companyName);
    $("#billingAddress").html(json.addressDetail + "<br>" + json.postalCode + " " + json.cityName + ", " + json.countryName);
    $("#emailAddress").html(json.email);
}

function displayCustomer(customerID) {

    $.ajax("./api/getCustomer.php?CustomerID=" + customerID, {
        async: false,
        type: "GET",
        data: "",
        success: function(data)
        {
            drawCustomerStructure(data);
        },
        error: function(a, b, c)
        {
            console.log(a + ", " + b + ", " + c);
        }
    })

    hideRestrictedElements();

    $("#loadingCustomer").fadeOut(400, function() {
        $("#customer").fadeIn('slow', function() {});
    });
}

function setCustomerID() {
    var customerID = getParameter(document.location.search).CustomerID;
    $("#customerIDInput").val(customerID);
}