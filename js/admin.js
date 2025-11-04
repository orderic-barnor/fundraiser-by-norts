jQuery(document).ready(function ($) {
  var blocksData = [];

  $("#page_select").on("change", function () {
    var pageID = $(this).val();
    if (!pageID) return;

    // Charger les blocs existants via AJAX
    $.post(
      ajaxurl,
      {
        action: "get_page_blocks",
        page_id: pageID,
      },
      function (data) {
        blocksData = data;
        renderBlocks();
      }
    );
  });

  function renderBlocks() {
    var container = $("#blocks_container");
    container.empty();
    blocksData.forEach(function (block, index) {
      var html =
        '<div class="block" data-index="' +
        index +
        '">' +
        "<strong>" +
        block.type +
        "</strong>" +
        ' <button class="edit">Edit</button>' +
        ' <button class="delete">Delete</button>' +
        "</div>";
      container.append(html);
    });

    // Ici tu peux ajouter jQuery UI sortable pour drag & drop
    container.sortable({
      update: function (event, ui) {
        // réorganiser blocksData selon le nouvel ordre
      },
    });
  }

  $("#save_blocks").on("click", function () {
    var pageID = $("#page_select").val();
    $.post(
      ajaxurl,
      {
        action: "save_page_blocks",
        page_id: pageID,
        blocks: JSON.stringify(blocksData),
      },
      function (resp) {
        alert("Blocs enregistrés !");
      }
    );
  });
});

jQuery(document).ready(function ($) {
  $("#save_params").on("click", function (e) {
    e.preventDefault();

    // Récupérer les valeurs
    let data = {
      action: "save_general_params",
      ong_facebook_lnk: $("#facebook_lnk").val(),
      ong_tiktok_lnk: $("#tiktok_lnk").val(),
      ong_twitter_lnk: $("#twitter_lnk").val(),
      ong_instagram_lnk: $("#instagram_lnk").val(),
      ong_linkedin_lnk: $("#linkedin_lnk").val(),
      ong_about_title: $("#ong_about_title").val(),
      ong_about_description: $("#ong_about_description").val(),
      footer_cta_btn_label: $("#footer_cta_btn_label").val(),
      footer_cta_btn_link: $("#footer_cta_btn_link").val(),
      footer_cta_btn_description: $("#footer_cta_btn_description").val(),
      _ajax_nonce: fundraiser_norts_ajax.nonce,
    };

    // Appel AJAX
    $.post(fundraiser_norts_ajax.ajax_url, data, function (response) {
      if (response.success) {
        alert(response.data.message || "Paramètres enregistrés ✅");
      } else {
        alert(response.data.message || "Erreur lors de l’enregistrement ❌");
      }
    });
  });
});

jQuery(document).ready(function ($) {
  $("#footer_cta_btn_link").select2({
    ajax: {
      url: fundraiser_norts_ajax.ajax_url,
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          action: "ong_search_posts",
          q: params.term,
        };
      },
      processResults: function (data) {
        return {
          results: data,
        };
      },
    },
    placeholder: "Lien du bouton",
    minimumInputLength: 2,
  });
});

jQuery(document).ready(function ($) {
  $('#dashboard-theme a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });

  // Au chargement de la page
  var activeTab = localStorage.getItem('activeTab');
  if (activeTab) {
    $('#dashboard-theme a[href="' + activeTab + '"]').tab('show');
  }
});

jQuery(document).ready(function ($) {
  var frame;
  $("#fbn-add-gallery").on("click", function (e) {
    e.preventDefault();

    if (frame) {
      frame.open();
      return;
    }

    frame = wp.media({
      title: "Sélectionner des images",
      button: {
        text: "Utiliser ces images",
      },
      multiple: true,
    });

    frame.on("select", function () {
      var attachments = frame.state().get("selection").toJSON();
      var ids = attachments.map(function (att) {
        return att.id;
      });
      var preview = "";

      ids.forEach(function (id) {
        preview +=
          '<li class="col-2" data-id="' +
          id +
          '"><img src="' +
          attachments.find((a) => a.id === id).sizes.thumbnail.url +
          '"></li>';
      });

      $("#fbn-gallery-container ul").html(preview);
      $("#fbn_gallery_ids").val(ids.join(","));
    });

    frame.open();
  });
});

// partner form
jQuery(document).ready(function ($) {
  var frame;
  let partners = []; // partners array

  // get partners from db
  $.post(
    ajaxurl,
    {
      action: "get_partners_list",
    },
    function (response) {
      if (response.success) {
        console.log("Partenaires mis à jour :", response.data.partners);
        if (response.data.partners.length) {
          partners = response.data.partners;
          renderList();
        }
        // alert("Partenaire enregistré !");
      }
    }
  );

  // Select new partner logo
  $("#partner_logo").on("click", function (e) {
    e.preventDefault();

    // console.log(frame);
    // if (frame) {
    //   frame.open();
    //   return;
    // }

    frame = window.wp.media({
      title: "Sélectionner le logo du partenaire",
      button: {
        text: "Utiliser cette image",
      },
      multiple: false,
    });

    frame.on("select", function () {
      var attachments = frame.state().get("selection").toJSON();

      var ids = attachments.map(function (att) {
        return att.id;
      });

      let id = ids[0];
      $("#partner-form .file-preview").css(
        "background-image",
        "url(" + attachments.find((a) => a.id === id).sizes.full.url + ")"
      );
      $("#partner-form .file-preview").removeClass("d-none");
      $("#partner_logo").data("id", id);
      $("#partner_logo").data(
        "src_url",
        attachments.find((a) => a.id === id).sizes.full.url
      );
    });

    frame.open();

  });

  function reset () {
$("#partner-form .file-preview").css("background-image", "none");
    $("#partner-form .file-preview").addClass("d-none");
    $("#partner_logo").data("id", "");
    $("#partner_logo").data("src_url", "");
    $("#partner_name").val("");
  }

  // reset form
  $("#partner-form-reset").on("click", function (e) {
    reset()
    
  });

  let editingIndex = null;

  function renderList() {
    const tbody = $("#partners-list tbody");
    const partnersListMobileContainer = $("#partners-list-mobile-container");
    tbody.empty();
    partners.forEach((p, i) => {
      tbody.append(`
        <tr>
          <td>${p.name}</td>
          <td>${p.logo_url ? '<img src="' + p.logo_url + '" />' : ""}</td>
          <td>
            <button class="delete" data-index="${p.id}">Supprimer</button>
          </td>
        </tr>
      `);

      partnersListMobileContainer.append(`
        <div class="col-12 p-3">
            <div class="border d-flex flex-column align-items-center p-3">
                <img src="${p.logo_url}" style="width: 30%;"/>
                <span>${p.name}</span>
                <button class="delete" data-index="${p.id}">Supprimer</button>
            </div>
        </div>
      `);
    });
  }

  function updateList(newPartner) {
    const tbody = $("#partners-list tbody");
    const partnersListMobileContainer = $("#partners-list-mobile-container");

    tbody.prepend(`
        <tr>
          <td>${newPartner.name}</td>
          <td>${
            newPartner.logo_url
              ? '<img src="' + newPartner.logo_url + '" />'
              : ""
          }</td>
          <td>
            <button class="delete" data-index="${
              newPartner.id
            }">Supprimer</button>
          </td>
        </tr>
    `);

    const mobileVersion = $(`
        <div class="col-12 p-3">
            <div class="border d-flex flex-column align-items-center p-3">
                <img src="${newPartner.logo_url}" style="width: 30%;"/>
                <span>${newPartner.name}</span> 
                <button class="delete" data-index="${newPartner.id}">Supprimer</button>
            </div>
        </div>   
    `);
    partnersListMobileContainer.prepend(mobileVersion);
    mobileVersion.slideDown(1000); // ou fadeIn(300)
  }

  // add partner
  $("#partner-form-add").on("click", function (e) {
    e.preventDefault();
    const partnerName = $("#partner_name").val();
    const logo_url = $("#partner_logo").data("src_url");
    const logo_id = $("#partner_logo").data("id");

    if (!partnerName || !logo_id) {
      alert("Nom ou logo manquant !");
      return;
    }

    $.post(
      ajaxurl,
      {
        action: "save_partner",
        name: partnerName,
        logo_id: logo_id,
        logo_url: logo_url,
      },
      function (response) {
        if (response.success) {
          console.log("Partenaires mis à jour :", response.data.saved);
          updateList(response.data.saved);
          reset();
          // alert("Partenaire enregistré !");
        }
      }
    );

    // if (editingIndex !== null) {
    //   partners[editingIndex] = { name, logo };
    //   editingIndex = null;
    // } else {
    //   partners.push({ name, logo });
    // }

    // renderList();
    // $(this)[0].reset();
  });

  // edit partner
  //   $("#partners-list").on("click", ".edit", function () {
  //     editingIndex = $(this).data("index");
  //     $("#partner_name").val(partners[editingIndex].name);
  //     $("#partner_id").val(editingIndex);
  //   });

  // delete partner
  $("#partners-list").on("click", ".delete", function () {
    const partner = $(this);
    const index = partner.data("index");
    $.post(
      ajaxurl,
      {
        action: "delete_partner",
        partner_id: index,
      },
      function (response) {
        if (response.success) {
          //   partners.splice(index, 1);
          partner
            .parent()
            .parent()
            .fadeOut(1000, function () {
              $(this).remove();
            });
          //   .remove();
          // renderList();
          console.log("Partenaires mis à jour :", response.data);
          // updateList(response.data.saved);
          // alert("Partenaire enregistré !");
        }
      }
    );
  });

  renderList();
});
