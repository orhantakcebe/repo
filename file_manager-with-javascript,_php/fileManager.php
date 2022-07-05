<!DOCTYPE html>
<html>
  <head>
    <title>title</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

  </head>
  <style>
    .divFileFolder {
      padding: 5px;
    }
    [data-ota-fm-text], [data-ota-fm-type] {
      user-select: none;
    }
    .iconText {
      font-size: 1.5rem;
    }
    .fixed {
      position: fixed;
      width: 100%;
    }
    .filemanager {
      border: 3px solid black;
    }

  </style>
  <body>
    <?php
    /*
     * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
     * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
     */
    ?>

    <!-- Modal -->
    <!-- data-animate-in data-animate-out - from https://github.com/esgi-dendyanri/bootstrap-animate-css -->
    <div class="modal fade" id="modalRename" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-animate-in='animate__zoomInUp' data-animate-out='animate__flipOutY'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please enter new name about file.</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">Rename</span>
              <input type="text" class="form-control" placeholder="Rename" aria-label="Rename" aria-describedby="basic-addon1">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- filemanager -->
    <!-- change data-ota-fm-path to your server folder location -->
    <div class="filemanager" data-ota-fm-path="/home/orhan" data-ota-fm-height="50vh" data-ota-fm-width="80%" data-ota-fm-overflow="auto">

    </div>
    <div class="filemanager" data-ota-fm-path="/home/orhan/public_html/news_portal/file_manager/" data-ota-fm-height="50vh" data-ota-fm-width="80%" data-ota-fm-overflow="auto">
    </div>
    <script>
      "use strict";
      document.addEventListener("DOMContentLoaded", function () {
        // fill inside of class of filemanager 
        let filemanagers = document.getElementsByClassName("filemanager");
        for (let i = 0; i < filemanagers.length; i++) {
          let filemanager = filemanagers[i];
          filemanager.dataset.id = i;
          filemanager.style.width = filemanager.dataset.otaFmWidth;

          // filemanager screen
          //filemanager.style.border = "4px solid black";
          let filemanagerScreen = document.createElement("div");
          filemanagerScreen.className = "filemanagerScreen";
          filemanagerScreen.style.height = filemanager.dataset.otaFmHeight;
          filemanagerScreen.style.overflow = filemanager.dataset.otaFmOverflow;

          filemanager.appendChild(filemanagerScreen);

          // utils container begin
          let otaFMUtilsContainer = document.createElement("div");
          otaFMUtilsContainer.className = "otaFMUtilsContainer";
          otaFMUtilsContainer.style.backgroundColor = "white";
          otaFMUtilsContainer.style.border = "3px solid black";

          // refresh
          let otaFMrefresh = document.createElement("span");
          otaFMrefresh.className = "otaFMrefresh";
          otaFMrefresh.classList.add("iconText");
          otaFMrefresh.style.margin = "1rem";
          let otaFMrefreshText = document.createTextNode("refresh");

          let refreshImg = document.createElement("img");
          refreshImg.src = "../img/refresh.jpg";
          refreshImg.style.height = "1rem";

          otaFMrefresh.appendChild(refreshImg);
          otaFMrefresh.appendChild(otaFMrefreshText);

          // rename
          let otaFMRename = document.createElement("span");
          otaFMRename.className = "otaFMRename";
          otaFMRename.classList.add("iconText");
          otaFMRename.style.margin = "1rem";
          let otaFMRenameText = document.createTextNode("rename");

          let renameImg = document.createElement("img");
          renameImg.src = "../img/rename.jpg";
          renameImg.style.height = "1rem";

          otaFMRename.appendChild(renameImg);
          otaFMRename.appendChild(otaFMRenameText);

          // open
          let otaFMOpen = document.createElement("span");
          otaFMOpen.className = "otaFMOpen";
          otaFMOpen.classList.add("iconText");
          otaFMOpen.style.margin = "1rem";
          let otaFMOpenText = document.createTextNode("open");

          let openImg = document.createElement("img");
          openImg.src = "../img/open.jpg";
          openImg.style.height = "1rem";

          otaFMOpen.appendChild(openImg);
          otaFMOpen.appendChild(otaFMOpenText);

          otaFMUtilsContainer.appendChild(otaFMrefresh);
          otaFMUtilsContainer.appendChild(otaFMRename);
          otaFMUtilsContainer.appendChild(otaFMOpen);

          filemanagerScreen.parentNode.insertBefore(otaFMUtilsContainer, filemanagerScreen);

          // utils container end

          /*<form action="fileManager" class="otaFMFilepath">
           <div class="input-group mb-3">
           <span class="input-group-text" id="basic-addon1">File Path</span>
           <input type="text" class="form-control" placeholder="Path" aria-label="Path" aria-describedby="basic-addon1" value="echo $path; ">
           <input class="btn btn-primary" type="button" value="Submit" class="otaFMFilepathButton">
           </div>
           </form>*/
          let otaFMFilepath = document.createElement("form");
          otaFMFilepath.className = "otaFMFilepath";
          let otaFMFilepathDiv = document.createElement("div");
          otaFMFilepathDiv.className = "input-group mb-3";
          let otaFMFilepathTitle = document.createElement("span");
          otaFMFilepathTitle.className = "input-group-text";
          otaFMFilepathTitle.id = "basic-addon1";
          otaFMFilepathTitle.innerHTML = "File Path";
          let otaFMFilepathInputFilepath = document.createElement("input");
          otaFMFilepathInputFilepath.type = "text";
          otaFMFilepathInputFilepath.className = "form-control otaFMFilepathInputFilepath";
          otaFMFilepathInputFilepath.placeholder = "Path";
          otaFMFilepathInputFilepath.ariaLabel = "Path";
          otaFMFilepathInputFilepath.ariaDescribedby = "basic-addon1";
          otaFMFilepathInputFilepath.value = "not set yet";
          let otaFMFilepathInputSubmit = document.createElement("input");
          otaFMFilepathInputSubmit.type = "button";
          otaFMFilepathInputSubmit.className = "btn btn-primary otaFMFilepathButton";
          otaFMFilepathInputSubmit.value = "Go";

          otaFMFilepathDiv.appendChild(otaFMFilepathTitle);
          otaFMFilepathDiv.appendChild(otaFMFilepathInputFilepath);
          otaFMFilepathDiv.appendChild(otaFMFilepathInputSubmit);
          otaFMFilepath.appendChild(otaFMFilepathDiv);

          filemanagerScreen.parentNode.insertBefore(otaFMFilepath, otaFMUtilsContainer.nextSibling);



        }

        let oneclick = false;
        let otaFMRenames = document.getElementsByClassName("otaFMRename");
        let fileBuffer = [[], []]; // Selected files array

        let otaFMOpens = document.getElementsByClassName("otaFMOpen");
        let otaFMrefresh_eventListener_registered = 0;
        let otaFMOpen_eventListener_registered = 0;
        let isOtaFMOpen_eventListener_bound = false;

        let attemptOpen = "";


        for (let i = 0; i < filemanagers.length; i++) {
          let otaFMFilepathButtons = document.querySelectorAll(".otaFMFilepathButton");
          if (otaFMFilepathButtons.length > 0) {
            let otaFMFilepathButton = otaFMFilepathButtons[i];
            function otaFMFilepathButton_eventListener(e) {
              e.preventDefault();
              attemptOpen = "";
              filemanagers[i].dataset.otaFmPath = document.getElementsByClassName("otaFMFilepathInputFilepath")[i].value;
              ajaxCall(i);
            }
            otaFMFilepathButton.addEventListener("click", otaFMFilepathButton_eventListener);
            otaFMFilepathButton.addEventListener("keypress", otaFMFilepathButton_eventListener);
          }
        }

        function ajaxCall(index) {
          let filemanagerScreens = document.getElementsByClassName("filemanagerScreen");
          let filemanagerIdNumber = filemanagerScreens[index].parentNode.dataset.id;
          let otaFMRename = otaFMRenames[index];

          let otaFMPath = filemanagers[index].dataset.otaFmPath;
          $.ajax({
            method: "POST",
            url: "list.php",
            success: function (result) {
              let fileBufferWithIndex = fileBuffer[index];

              function checkForFileBufferEqualToOne(fileBufferWithIndex, otaFMRename) {
                if (fileBufferWithIndex.length === 1) {
                  // data-bs-toggle="modal" data-bs-target="#exampleModal"
                  otaFMRename.dataset.bsToggle = "modal";
                  otaFMRename.dataset.bsTarget = "#modalRename";
                } else {
                  otaFMRename.dataset.bsToggle = "";
                  otaFMRename.dataset.bsTarget = "";
                }
              }
              $(".filemanagerScreen").eq(index).html(result);

              let divFilefolder = document.querySelectorAll("div[data-ota-fm-type=fileFolder" + index + "]");

              function filemanager() {
                let divFilefolderPop;
                while ((divFilefolderPop = fileBufferWithIndex.pop()) !== undefined) {
                  divFilefolderPop.style.backgroundColor = "";
                  divFilefolderPop.style.color = "";
                }

                for (let i = 0; i < divFilefolder.length; i++) {
                  let file = divFilefolder[i];
                  file.addEventListener("click", function (e) {

                    if (!e.ctrlKey) {
                      if (fileBufferWithIndex.length > 0) {
                        let divFilefolderPop;
                        while ((divFilefolderPop = fileBufferWithIndex.pop()) !== undefined) {
                          divFilefolderPop.style.backgroundColor = "";
                          divFilefolderPop.style.color = "";
                        }
                      }
                      fileBufferWithIndex.push(divFilefolder[i]);
                      console.log(fileBufferWithIndex.length);
                      checkForFileBufferEqualToOne(fileBufferWithIndex, otaFMRename);
                      divFilefolder[i].style.backgroundColor = "blue";
                      divFilefolder[i].style.color = "white";
                    } else {
                      let found = false;
                      for (let k = 0; k < fileBufferWithIndex.length; k++) {
                        if (this === fileBufferWithIndex[k]) {
                          fileBufferWithIndex[k].style.backgroundColor = "";
                          fileBufferWithIndex[k].style.color = "";
                          console.log("splice before" + fileBufferWithIndex.length);
                          fileBufferWithIndex.splice(k, 1);
                          console.log("splice after" + fileBufferWithIndex.length);
                          checkForFileBufferEqualToOne(fileBufferWithIndex, otaFMRename);
                          found = true;
                          break;
                        }
                      }
                      if (found === false) {
                        fileBufferWithIndex.push(divFilefolder[i]);
                        checkForFileBufferEqualToOne(fileBufferWithIndex, otaFMRename);
                        divFilefolder[i].style.backgroundColor = "blue";
                        divFilefolder[i].style.color = "white";
                      }
                    }
                    console.log("index: " + index);
                    console.log(fileBufferWithIndex);
                    console.log("-----");

                    //divFilefolder[i].style.height = "50px";
                  });
                  file.addEventListener("dblclick", function () {

                  });

                }
              }

              filemanager();

            },
            data: {
              filemanagerIdNumber: filemanagerIdNumber,
              otaFMPath: otaFMPath,
              attemptOpen: attemptOpen
            }
          });
        }
        for (let i = 0; i < filemanagers.length; i++) {
          //let otaFMsubmit = otaFMsubmits[i];
          ajaxCall(i);
        }

        for (let i = 0; i < filemanagers.length; i++) {
          let otaFMrefreshs = document.getElementsByClassName("otaFMrefresh");
          let otaFMrefresh = otaFMrefreshs[i];
          function otaFMrefresh_eventListener() {
            attemptOpen = "";
            ajaxCall(i);
          }
          otaFMrefresh.addEventListener("click", otaFMrefresh_eventListener);
        }

        for (let i = 0; i < filemanagers.length; i++) {
          function FMRename_eventListener() {
            let fileBufferWithIndex = fileBuffer[i];
            if (fileBufferWithIndex.length === 1) {
              $("#modalRename .input-group-text").html(fileBufferWithIndex[0].dataset.otaFmFilefoldername);
            } else {
            }
          }
          let otaFMRename = otaFMRenames[i];
          otaFMRename.addEventListener("click", FMRename_eventListener);
        }

        for (let i = 0; i < filemanagers.length; i++) {
          let otaFMOpen = otaFMOpens[i];
          function otaFMOpen_eventListener() {
            let fileBufferWithIndex = fileBuffer[i];

            console.log("otaFMOpen_eventListener" + fileBufferWithIndex.length);
            if (fileBufferWithIndex.length === 1) {
              if (fileBufferWithIndex[0].dataset.otaFmFilefolderType === "folder") {
                attemptOpen = fileBufferWithIndex[0].dataset.otaFmFilefoldername;
              }
            } else {
              attemptOpen = "";
            }
            console.log(attemptOpen);
            ajaxCall(i);
          }
          otaFMOpen.addEventListener("click", otaFMOpen_eventListener);
        }
        
        // prevent enter key which submit form
        $(document).ready(function () {
          $(window).keydown(function (event) {
            if (event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          });
        });

      });
    </script>
    <script>
      // bootstrap "animation css"(software) - from https://github.com/esgi-dendyanri/bootstrap-animate-css
      (function ($) {
        $.fn.bmcModal = function () {
          var self = $(this);

          if (self.attr('data-animate-in')) {
            self.addClass('animate__animated');
            self.addClass(self.attr('data-animate-in'));
          }

          self.on('hide.bs.modal', function (event) {
            if (!self.attr('data-end-hide') && self.attr('data-animate-out')) {
              event.preventDefault();

              self.addClass(self.attr('data-animate-out'));
              if (self.attr('data-animate-in')) {
                self.removeClass(self.attr('data-animate-in'));
              }
            }
            self.removeAttr('data-end-hide');
          })
                  .on('animationend', function () {
                    if (self.attr('data-animate-out') && self.hasClass(self.attr('data-animate-out'))) {
                      self.attr('data-end-hide', true);
                      self.modal('hide');
                      self.removeClass(self.attr('data-animate-out'));
                      if (self.attr('data-animate-in')) {
                        self.addClass(self.attr('data-animate-in'));
                      }
                    }
                  })
        };

        $(document).ready(function () {
          $('.modal').bmcModal();
        })
      })(jQuery);

    </script>

  </body>
</html>

