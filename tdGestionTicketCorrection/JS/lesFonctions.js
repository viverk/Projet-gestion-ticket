function ModifierTicket(idTicket,statut,idUser)
{
    $.ajax(
    {
        type:"get",
        url:"../PHP/ModifierTicket.php",
        data:"idTicket="+idTicket+"&statut="+statut+"&idUser="+idUser,
        success:function(data)
        {
            $('#divModificationTicket').empty();
            $('#divModificationTicket').append(data);
        },
        error:function()
        {
            alert('Erreur SQL');
        }
    }
    );
}