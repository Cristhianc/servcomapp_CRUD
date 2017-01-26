var facultadSeleccionada = -1;

function onSelect(id) {
    facultadSeleccionada = id;
    $("#buttons").addClass("hide");
    $("#lista").removeClass("hide");
    $("#btn-add").addClass("hide");
    $("#btn-inicio").removeClass("hide");
}

function home() {
    facultadSeleccionada = -1;
    $("#buttons").removeClass("hide");
    $("#add").addClass("hide");
    $("#lista").addClass("hide");
    $("#btn-add").removeClass("hide");
    $("#btn-inicio").addClass("hide");
}

function add() {
    $("#buttons").addClass("hide");
    $("#add").removeClass("hide");
    $("#lista").addClass("hide");
    $("#btn-inicio").removeClass("hide");
    $("#btn-add").addClass("hide");
}