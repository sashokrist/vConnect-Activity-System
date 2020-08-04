// 'use strict';

document.addEventListener('DOMContentLoaded', (event) => {

    // Resolving bootstrap and datatables conflict:
    $('body .dropdown-btn').dropdown();

    const overlay = document.querySelector('.myImgModal');
    const modal = document.getElementById('myDocModal');
    const modalMask = document.querySelector('#modal-mask');

    // Burger menu toggle:

    const nav = document.querySelector('header .navbar');
    const wrapper = document.querySelector('.wrapper');
    const toggler = document.querySelector('#sidebar-toggler');
    const sidebar = document.querySelector('.sidebar');
    const dropdownMenus = document.getElementsByClassName('dropdown-menu');

    toggler.onclick = () => {
        const mq = window.matchMedia( '(max-width: 1200px)' );

        if (!mq.matches) {
            if (sidebar.classList.contains('shrink')) {
                wrapper.style.margin = '0px 0px 0px 255px';
            }
            else {
                wrapper.style.margin = '0px 0px 0px 55px';
            }
        }
        else {
            wrapper.style.margin = '0px 0px 0px 55px';
        }

        sidebar.classList.toggle('shrink');
        wrapper.classList.toggle('expand');
        nav.classList.toggle('expand');

        const navCollapsed = sidebar.classList.contains('shrink') ? 'true' : 'false';

        if (navCollapsed === 'true') {

            for (var i = 0; i < dropdownMenus.length; i++) {
                var dropdownMenu = dropdownMenus[i];
                dropdownMenu.classList.remove('active');
            }
        }
        window.localStorage.setItem('navCollapsed', navCollapsed);
    }

    function setNavigationState() {
        const navCollapsed = window.localStorage.getItem('navCollapsed');
        const mq = window.matchMedia( '(max-width: 1200px)' );

        if (mq.matches) {
            wrapper.style.margin = '0px 0px 0px 55px';
        }
        if (navCollapsed === 'true') {
            sidebar.classList.add('shrink');
            wrapper.classList.add('expand');
            nav.classList.add('expand');
            for (var i = 0; i < dropdownMenus.length; i++) {
                var dropdownMenu = dropdownMenus[i];
                dropdownMenu.classList.remove('active');
            }
        }
    }

    // Automatic shrink/expand the side menu when the window is resized

    window.addEventListener('resize', (event) => {
        const mq = window.matchMedia( '(max-width: 1200px)' );
    
        if (mq.matches) {
            sidebar.classList.add('shrink');
            wrapper.classList.add('expand');
            nav.classList.add('expand');
            wrapper.style.margin = '0px 0px 0px 55px';
        } else {
            sidebar.classList.remove('shrink');
            wrapper.classList.remove('expand');
            nav.classList.remove('expand');
            wrapper.style.margin = '0px 0px 0px 255px';
        }
    });

    // Side menu - highlight current item functions:

    const sidemenu = document.querySelector('.navbar-nav');
    const navBarItems = sidemenu.children;
    
    for (var i = 0; i < navBarItems.length; i++) {
        var navBarItem = navBarItems[i];
        navBarItem.addEventListener('click', onItemClick);
    }

    function onItemClick() {
        const link = this.getElementsByTagName('a')[0];
        const dropdown = this.getElementsByTagName('div')[0];

        if (this.classList.contains('active')) {
            dropdown.classList.remove('active');
            link.classList.remove('active');
            this.classList.remove('active');
        }
        else {
            removeAllActive();
            dropdown.classList.add('active');
            link.classList.add('active');
            this.classList.add('active');
        }
    }

    function removeAllActive() {

        for (var i = 0; i < navBarItems.length; ++i) {

            var item = navBarItems[i];
            
            if (item.classList.contains('dropdown')) {
                item.classList.remove('active');
                var link = item.getElementsByTagName('a')[0];
                var dropdown = item.getElementsByTagName('div')[0];
                link.classList.remove('active');
                dropdown.classList.remove('active');
            }
            else {
                item.classList.remove('active');
            }
        }
    }

    setCurrentNavItem();
    setNavigationState();

    function setCurrentNavItem() {

        for (var i = 0; i < navBarItems.length; ++i) {
            const item = navBarItems[i];
            const link = item.getElementsByTagName('a')[0];
            const currPath = link.href;
            
            if (item.className === 'nav-item') {

                if (currPath === window.location.href) {
                    link.classList.add('active');
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            }
            else if (item.className === 'nav-item dropdown') {
                const dropdown = item.getElementsByTagName('div')[0];
                const subItems = dropdown.getElementsByTagName('a');

                for (var j = 0; j < subItems.length; j++) {
                    const subItem = subItems[j];

                    if (subItem.href === window.location.href) {
                        dropdown.classList.add('active');
                        link.classList.add('active');
                        item.classList.add('active');
                        subItem.classList.add('active');
                    }
                }
            }  
        }
    }

    // Select2 settings:

    $('.select2').select2({
        placeholder : 'Select Tags',
        closeOnSelect : false,
        allowClear: true,
        tags: true
    });

    // Lightbox for Images:

    expandThumbnailAndSlide();

    function expandThumbnailAndSlide() {
        
        const thumbnail = document.getElementsByClassName('thumbnail');
        const slideContent = document.querySelector('.myImgModal-carousel-inner');
        const close = document.querySelector('.modal-close');

        for (var l = 0; l < thumbnail.length; l++) {

            const currentThumbnail = thumbnail[l];
            var div = document.createElement('div');
            div.className = 'item';
            div.innerHTML = '<div class="container"><img src="' + currentThumbnail.firstElementChild.src + '"></div>';
            slideContent.appendChild(div);

            $('#myCarousel').carousel({
                interval: false
            })

            currentThumbnail.addEventListener('click',  function(e) {
                
                e.preventDefault();
                overlay.classList.add('visible');
                modalMask.classList.add('visible');
                const currentSrc = this.firstElementChild.src;

                for (var carouselIndex = 0; carouselIndex < slideContent.childNodes.length; carouselIndex++) {
                    const element = slideContent.childNodes[carouselIndex];
                    const elementImgSrc = element.getElementsByTagName('img')[0].src;

                    if (currentSrc === elementImgSrc) {
                        element.classList.add('active');
                    }
                    else {
                        element.classList.remove('active');
                    }
                }
            });
        }

        if (close) {

            close.addEventListener('click', function(e) {
                e.preventDefault();
                overlay.classList.remove('visible');
                modalMask.classList.remove('visible');
            });
        }
    }


    // Lightbox for Docs:

    openFilesSlider();

    function openFilesSlider() {
        
        const file = document.getElementsByClassName('attachment');
        const docsSlideContent = document.querySelector('.myDocModal-carousel-inner');
        const closeModal = document.querySelector('.DocModal-close');

        for (var m = 0; m < file.length; m++) {
            const currentFile = file[m];
            const dataContent = currentFile.getAttribute('data-href');
            const docViewerLink = 'http://docs.google.com/gview?url=' + dataContent + '&embedded=true';

            var div = document.createElement('div');
            div.className = 'item';
            div.innerHTML = `<div class="container"><iframe href-attribute="${dataContent}" src="${docViewerLink}"></iframe></div>`;
            docsSlideContent.appendChild(div);

            $('#myCarousel2').carousel({
                interval: false
            })

            currentFile.addEventListener('click',  function(e) {
                
                e.preventDefault();
                modal.classList.add('visible');
                modalMask.classList.add('visible');
                const currentFileSrc = this.getAttribute('data-href');
                const downloadButton = document.getElementById('downloadFileBtn');
                downloadButton.href = dataContent;

                for (var n = 0; n < docsSlideContent.childNodes.length; n++) {
                    const carouselItem = docsSlideContent.childNodes[n];
                    const carouselItemSrc = carouselItem.getElementsByTagName('iframe')[0].src;
                    const urlPart = carouselItemSrc.split('http://docs.google.com/gview?url=').pop().split('&embedded=true')[0];
                    const dоcUrlPart = decodeURI(urlPart);

                    if (currentFileSrc === dоcUrlPart) {
                        carouselItem.classList.add('active');
                    }
                    
                    else {
                        carouselItem.classList.remove('active');
                    }
                }

            });
        }

        if (closeModal) {
            closeModal.addEventListener('click', function(e) {
                e.preventDefault();
                modal.classList.remove('visible');
                modalMask.classList.remove('visible');
            });
        }

    }

    // Update download button on carousel slide:

    $('#myCarousel2').on('slid.bs.carousel', function () {
        const downloadButton = document.getElementById('downloadFileBtn');
        var currentLink = this.getElementsByClassName('item active')[0].getElementsByTagName('iframe')[0].getAttribute("href-attribute");
        downloadButton.href = currentLink;       
    })

    // Close modal when click aside:

    window.onclick = function(event) {

        if (event.target == modalMask) {
            overlay.classList.remove('visible');
            modal.classList.remove('visible');
            modalMask.classList.remove('visible');
        }

    }

    // Show more content:

    const toggleItemBtns = document.getElementsByClassName('toggle-item');
    const itemBoxes = document.getElementsByClassName('item-box');
    const icon = document.getElementById('icon');
    const iconArrows = document.getElementById('icon-arrows');

    for (var k = 0; k < toggleItemBtns.length; k++) {
        var currentBtn = toggleItemBtns[k];
        currentBtn.addEventListener('click', onToggleBtnClick);
    }

    function onToggleBtnClick() {

        for (var k = 0; k < toggleItemBtns.length; k++) {
            if(this !== toggleItemBtns[k]) {
                toggleItemBtns[k].showContent = false;
            }
        }

        this.showContent = !this.showContent
        var target = this.nextElementSibling;

        if( this.showContent) {
            removeItemBoxesActive();
            target.style.height = target.scrollHeight + "px";
            if (icon) {
                icon.innerHTML = '<i class="fas fa-minus-square"></i>';
            }
            if (iconArrows) {
                iconArrows.innerHTML = '<i class="fas fa-angle-double-up"></i>';
            }
        }
        else {
            target.style.height = 0;
            if (icon) {
                icon.innerHTML = '<i class="fas fa-plus-square"></i>';
            }
            if (iconArrows) {
                iconArrows.innerHTML = '<i class="fas fa-angle-double-down"></i>';
            }
        }
    }

    function removeItemBoxesActive() {
        for (var k = 0; k < itemBoxes.length; k++) {
            var currentItemBox = itemBoxes[k];
            if (!(currentItemBox.style.height = 0)) {
                currentItemBox.style.height = 0;
            }
        }
    }

    // Update profile image on upload:

    var input = document.querySelector('#avatar');
    if (input) {
        input.addEventListener('change', readURL);
    }

    function readURL() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var imageContainer = document.querySelector('#avatar-img');
                imageContainer.setAttribute('src', e.target.result);
            };

            reader.readAsDataURL(this.files[0]);
            var choseFile = document.querySelector('#choose-file');
            choseFile.style.visibility = 'hidden';

            var uploadButtons = document.querySelector('#buttons');
            uploadButtons.style.visibility = 'visible';     
        }
    }

    // Cancel chosen image:
    
    var cancelButton = document.querySelector('#cancel-btn');
    if (cancelButton) {
        cancelButton.addEventListener('click', cancelUpload);
    }
    
    function cancelUpload() {
        var choseFile = document.querySelector('#choose-file');
        choseFile.style.visibility = 'visible';

        var uploadButtons = document.querySelector('#buttons');
        uploadButtons.style.visibility = 'hidden'; 

        var imageContainer = document.querySelector('#avatar-img');
        imageContainer.setAttribute('src', currentAvatarImg);
    }

    // Customised Select Menu:

    var dropdowns = document.querySelectorAll(".custom-select-wrapper");

    for (var p = 0; p < dropdowns.length; p++) {
        var dropdown = dropdowns[p];

        dropdown.addEventListener('click', function() {
            this.querySelector('.custom-select').classList.toggle('open');
        })
    }

    var options = document.querySelectorAll('.custom-option');

    for (var r = 0; r < options.length; r++) {
        var option = options[r];

        option.addEventListener('click', function() {
            removeListItemsActive();
    
            if (!this.classList.contains('selected')) {
                var caption = this.closest('.custom-select').querySelector('.custom-select__trigger span');
                this.classList.add('selected');
                caption.textContent = this.textContent;
                caption.style.color = '#4e5b72';
            }
        })

        function removeListItemsActive() {
            for (var r = 0; r < options.length; r++) {
                var currentListItem = options[r];
                if (currentListItem.classList.contains('selected')) {
                    currentListItem.classList.remove('selected');
                }
            }
        }

    }

    window.addEventListener('click', function(e) {
        var selects = document.querySelectorAll('.custom-select');

        for (var q = 0; q < selects.length; q++) {
            var select = selects[q];
            if (!select.contains(e.target)) {
                select.classList.remove('open');
            }
        }

    });

    // Create News - customise input file on change:

    var inputs = document.querySelectorAll( '.inputfile' );

    for (var t = 0; t < inputs.length; t++) {
        var input = inputs[t];

        input.addEventListener('change', function(e) {
            var fileName = '';

            if ( this.files && this.files.length > 1 ) {
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            }
            else {
                fileName = e.target.value.split( '\\' ).pop();
            }
            if ( fileName ) {
                var parent = this.parentElement;
                var label = this.nextElementSibling;
                var labelVal = label.innerHTML;
                var clearButton = parent.querySelector('.clear');

                label.querySelector( '.file-choosen' ).innerHTML = fileName;
                label.querySelector( '.file-choosen' ).classList.add('active');
                clearButton.classList.add('active');
            }
            else {
                label.innerHTML = labelVal;
            }

        })
    }

    var clearButtons = document.querySelectorAll('.clear');

    for (let i = 0; i < clearButtons.length; i++) {
        const clearButton = clearButtons[i];
        clearButton.addEventListener('click', clearFileInput);       
    }
    
    function clearFileInput() {
        var parentElement = this.parentElement;
        var inputElement = parentElement.querySelector('input');
        var labelElement = parentElement.querySelector('label');
        var label = labelElement.querySelector('.file-choosen');

        try {
            inputElement.value = null;
        } catch(ex) { 
            if (inputElement.value) {
                inputElement.parentNode.replaceChild(inputElement.cloneNode(true), inputElement);
            }
        }
        this.classList.remove('active');
        label.classList.remove('active');
        label.innerHTML = '';
    }

    // Create Poll - Add new answer option dynamically:

    var answersCount = 1;
    var limit = 10;
    const demo = document.getElementById('addInput');

    demo.addEventListener('click', addInput);

    function addInput(){
        if (answersCount == limit)  {
            alert("You have reached the limit of adding " + answersCount + " inputs");
        }
        else {
            var newdiv = document.createElement('div');
            answersCount++;
            var dynamicId = "img" + answersCount;

            newdiv.classList.add('form-group', 'option-container');
            newdiv.innerHTML = 
            `<input type="text" name="answers[]" class="form-control"  placeholder="Enter answer...">
            <div class="upload-wrap">
                <input type="file" name="filenames[]" id="${dynamicId}" class="dataInputField myfrm inputimage"/>
                <label for="${dynamicId}" class="forupload">
                    <strong><i class="far fa-image"></i></strong>
                </label>
            </div>
            <button class="btn remove-option" type="button"><i class="fldemo glyphicon glyphicon-remove"></i></button>`;
            document.getElementById('dynamicInputs').appendChild(newdiv);

            var removeOptions = document.querySelectorAll( '.remove-option' );

            for (var i = 0; i < removeOptions.length; i++) {
                var removeOption = removeOptions[i];
        
                removeOption.addEventListener('click', function() {
                    this.parentNode.remove();
                });
            }
        }
    }

    // Create Poll - customise input files on click:

    var pollInputs = document.querySelectorAll( '.dataInputField' );

    for (var i = 0; i < pollInputs.length; i++) {
        var pollInput = pollInputs[i];

        pollInput.addEventListener('click', function() {
            const selectedInput = document.querySelector('.active');

            if (selectedInput) {
                selectedInput.classList.remove('active');
            }
            this.classList.add('active');

        }, false);
    }

    // Create Poll - Add new answer option:

    // $(".btn-success").click(function(){
    //     var lsthmtl = $(".clone").html();
    //     $(".increment").after(lsthmtl);
    // });

    // const addInputBtn = document.querySelector('.btn-success');

    // addInputBtn.addEventListener('click', cloneContent);

    // function cloneContent(event) {
    //     event.preventDefault();
    //     const element = document.querySelector('.clone-me');
    //     const elContainer = document.querySelector('.new-content');
    //     var newOption = element.cloneNode(true);

    //     elContainer.appendChild(newOption);
    // }

    
    // Page Polls - highlight selected option:

    var optionElements = document.querySelectorAll('.form-check-label');

    for (let i = 0; i < optionElements.length; i++) {
        const optionElement = optionElements[i];

        optionElement.addEventListener('click', function() {
            const selectedEl = document.querySelector('.selected');

            if (selectedEl) {
                selectedEl.classList.remove('selected');
            }
            this.classList.add('selected');

        }, false);

    }
    
});