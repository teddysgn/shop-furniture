<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<?php
    // Input
    $inputName          = Helper::cmsInput('text'   , 'form[name]'      , 'name'        , $this->arrayParam['form']['name']     , 'inputbox form-control');
    $inputPrice         = '<input           type="text"     name="form[price]"        id="price"         value="'.number_format($this->arrayParam['form']['price']).'" placeholder="" class="inputbox required form-control" size="40" onkeyup="inputChange()">';
    $inputStock         = Helper::cmsInput('text'   , 'form[stock]'     , 'stock'       , $this->arrayParam['form']['stock']    , 'inputbox required form-control', '40', 'readonly');
    $inputSaleOff       = Helper::cmsInput('text'   , 'form[sale_off]'  , 'password'    , $this->arrayParam['form']['sale_off'] , 'inputbox form-control', '40');
    $inputOrdering      = Helper::cmsInput('text'   , 'form[ordering]'  , 'ordering'    , $this->arrayParam['form']['ordering'] , 'inputbox form-control', '40');
    $inputToken         = Helper::cmsInput('hidden' , 'form[token]'     , 'token'       , time());
    $inputPicture1      = Helper::cmsInput('file'   , 'picture1'        , 'picture1'    , $this->arrayParam['form']['picture1'] , 'inputbox form-control', '40');
    $inputPicture2      = Helper::cmsInput('file'   , 'picture2'        , 'picture2'    , $this->arrayParam['form']['picture2'] , 'inputbox form-control', '40');
    $inputPicture3      = Helper::cmsInput('file'   , 'picture3'        , 'picture3'    , $this->arrayParam['form']['picture3'] , 'inputbox form-control', '40');
    $inputPicture4      = Helper::cmsInput('file'   , 'picture4'        , 'picture4'    , $this->arrayParam['form']['picture4'] , 'inputbox form-control', '40');
    $inputPicture5      = Helper::cmsInput('file'   , 'picture5'        , 'picture5'    , $this->arrayParam['form']['picture5'] , 'inputbox form-control', '40');
    $inputPicture6      = Helper::cmsInput('file'   , 'picture6'        , 'picture6'    , $this->arrayParam['form']['picture6'] , 'inputbox form-control', '40');
    $inputPicture7      = Helper::cmsInput('file'   , 'picture7'        , 'picture7'    , $this->arrayParam['form']['picture7'] , 'inputbox form-control', '40');
    $inputPicture8      = Helper::cmsInput('file'   , 'picture8'        , 'picture8'    , $this->arrayParam['form']['picture8'] , 'inputbox form-control', '40');
    $inputPicture9      = Helper::cmsInput('file'   , 'picture9'        , 'picture9'    , $this->arrayParam['form']['picture9'] , 'inputbox form-control', '40');
    $inputPicture10      = Helper::cmsInput('file'  , 'picture10'       , 'picture10'   , $this->arrayParam['form']['picture10'], 'inputbox form-control', '40');
    $inputPicture11      = Helper::cmsInput('file'  , 'picture11'       , 'picture11'   , $this->arrayParam['form']['picture11'], 'inputbox form-control', '40');
    $inputPicture12      = Helper::cmsInput('file'  , 'picture11'       , 'picture12'   , $this->arrayParam['form']['picture12'], 'inputbox form-control', '40');

    $inputDescription   = '<textarea id="editor1" rows="100" name="form[description]" class="form-control" style="color: black;">'.$this->arrayParam['form']['description'].'</textarea>';

    $slbStatus          = Helper::cmsSelectbox('form[status]'       , 'inputbox form-control', array('default' => 'Select Status'   , 0 => 'Unpublish'  , 1 => 'Publish')   , isset($this->arrayParam['form']['status']) ? $this->arrayParam['form']['status'] : 'default'   , 'width: 230px; padding: 3px');
    $slbSpecial         = Helper::cmsSelectbox('form[special]'      , 'inputbox form-control', array('default' => 'Select Special'  , 0 => 'No'         , 1 => 'Yes')       , isset($this->arrayParam['form']['special']) ? $this->arrayParam['form']['special'] : 'default'  , 'width: 230px; padding: 3px');
    $slbCategory		= Helper::cmsSelectbox('form[category_id]'  , 'inputbox form-control', $this->slbCategory   , $this->arrayParam['form']['category_id']  , 'width: 230px; padding: 3px');
    $slbCollection		= Helper::cmsSelectbox('form[collection_id]', 'inputbox form-control', $this->slbCollection , $this->arrayParam['form']['collection_id'], 'width: 230px; padding: 3px');
    $slbDesigner		= Helper::cmsSelectbox('form[designer_id]'  , 'inputbox form-control', $this->slbDesigner   , $this->arrayParam['form']['designer_id']  , 'width: 230px; padding: 3px');

    $inputID            = '';
    $rowID              = '';
    $rowName            = Helper::cmsRowForm('Name', $inputName, true);
    $picture            = '';

    $picture1	            = '<img style="width:100%; background-color: #d1c286" id="display_image1" src="'.$imageURL.'/default.png">';
    $picture2	            = '<img style="width:100%; background-color: #d1c286" id="display_image2" src="'.$imageURL.'/default.png">';
    $picture3	            = '<img style="width:100%; background-color: #d1c286" id="display_image3" src="'.$imageURL.'/default.png">';
    $picture4	            = '<img style="width:100%; background-color: #d1c286" id="display_image4" src="'.$imageURL.'/default.png">';
    $picture5	            = '<img style="width:100%; background-color: #d1c286" id="display_image5" src="'.$imageURL.'/default.png">';
    $picture6	            = '<img style="width:100%; background-color: #d1c286" id="display_image6" src="'.$imageURL.'/default.png">';
    $picture7	            = '<img style="width:100%; background-color: #d1c286" id="display_image7" src="'.$imageURL.'/default.png">';
    $picture8	            = '<img style="width:100%; background-color: #d1c286" id="display_image8" src="'.$imageURL.'/default.png">';
    $picture9	            = '<img style="width:100%; background-color: #d1c286" id="display_image9" src="'.$imageURL.'/default.png">';
    $picture10	            = '<img style="width:100%; background-color: #d1c286" id="display_image10" src="'.$imageURL.'/default.png">';
    $picture11	            = '<img style="width:100%; background-color: #d1c286" id="display_image11" src="'.$imageURL.'/default.png">';
    $picture12	            = '<img style="width:100%; background-color: #d1c286" id="display_image12" src="'.$imageURL.'/default.png">';

if(isset($this->arrayParam['id']) || $this->arrayParam['form']['id']) {
        $inputID                = Helper::cmsInput('number', 'form[id]', 'id', $this->arrayParam['form']['id'], 'inputbox form-control readonly', null, 'readonly');
        $rowID                  = Helper::cmsRowForm('ID', $inputID);
        $inputName              = Helper::cmsInput('text', 'form[name]', 'name', $this->arrayParam['form']['name'], 'inputbox form-control readonly', null, 'readonly');
        $rowName                = Helper::cmsRowForm('Name', $inputName);
        $inputPicture1Hidden    = Helper::cmsInput('hidden', 'form[picture1_hidden]', 'picture1_hidden', $this->arrayParam['form']['picture1'], 'inputbox', '40');
        $inputPicture2Hidden    = Helper::cmsInput('hidden', 'form[picture2_hidden]', 'picture2_hidden', $this->arrayParam['form']['picture2'], 'inputbox', '40');
        $inputPicture3Hidden    = Helper::cmsInput('hidden', 'form[picture3_hidden]', 'picture3_hidden', $this->arrayParam['form']['picture3'], 'inputbox', '40');
        $inputPicture4Hidden    = Helper::cmsInput('hidden', 'form[picture4_hidden]', 'picture4_hidden', $this->arrayParam['form']['picture4'], 'inputbox', '40');
        $inputPicture5Hidden    = Helper::cmsInput('hidden', 'form[picture5_hidden]', 'picture5_hidden', $this->arrayParam['form']['picture5'], 'inputbox', '40');
        $inputPicture6Hidden    = Helper::cmsInput('hidden', 'form[picture6_hidden]', 'picture6_hidden', $this->arrayParam['form']['picture6'], 'inputbox', '40');
        $inputPicture7Hidden    = Helper::cmsInput('hidden', 'form[picture7_hidden]', 'picture7_hidden', $this->arrayParam['form']['picture7'], 'inputbox', '40');
        $inputPicture8Hidden    = Helper::cmsInput('hidden', 'form[picture8_hidden]', 'picture8_hidden', $this->arrayParam['form']['picture8'], 'inputbox', '40');
        $inputPicture9Hidden    = Helper::cmsInput('hidden', 'form[picture9_hidden]', 'picture9_hidden', $this->arrayParam['form']['picture9'], 'inputbox', '40');
        $inputPicture10Hidden   = Helper::cmsInput('hidden', 'form[picture10_hidden]', 'picture10_hidden', $this->arrayParam['form']['picture10'], 'inputbox', '40');
        $inputPicture11Hidden   = Helper::cmsInput('hidden', 'form[picture11_hidden]', 'picture11_hidden', $this->arrayParam['form']['picture11'], 'inputbox', '40');
        $inputPicture12Hidden   = Helper::cmsInput('hidden', 'form[picture12_hidden]', 'picture12_hidden', $this->arrayParam['form']['picture12'], 'inputbox', '40');

    }


    // Row
    $rowPrice           = Helper::cmsRowForm('Price'        , $inputPrice   , true);
    $rowStock           = Helper::cmsRowForm('Stock'        , $inputStock   , true);
    $rowDescription     = Helper::cmsRowForm('Description'  , $inputDescription);
    $rowSaleOff         = Helper::cmsRowForm('Sale Off'     , $inputSaleOff , true);
    $rowOrdering        = Helper::cmsRowForm('Ordering'     , $inputOrdering, true);
    $rowStatus          = Helper::cmsRowForm('Status'       , $slbStatus);
    $rowSpecial         = Helper::cmsRowForm('Special'      , $slbSpecial);
    $rowCategory        = Helper::cmsRowForm('Category'     , $slbCategory);
    $rowCollection      = Helper::cmsRowForm('Collection'   , $slbCollection);
    $rowDesigner        = Helper::cmsRowForm('Designer'     , $slbDesigner);

    if($this->arrayParam['form']['picture1'] == null)
        $rowPicture1 = Helper::cmsRowForm('Picture 1', $inputPicture1.$picture1);
    else{
        $picture1	 = '<img style="width:100%" id="display_image1" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture1'].'">';
        $rowPicture1 = Helper::cmsRowForm('Picture 1', $inputPicture1.$picture1.$inputPicture1Hidden);
    }
    if($this->arrayParam['form']['picture2'] == null)
        $rowPicture2 = Helper::cmsRowForm('Picture 2', $inputPicture2.$picture2);
    else{
        $picture2	 = '<img style="width:100%" id="display_image2" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture2'].'">';
        $rowPicture2 = Helper::cmsRowForm('Picture 2', $inputPicture2.$picture2.$inputPicture2Hidden);
    }

    if($this->arrayParam['form']['picture3'] == null){
        $rowPicture3 = Helper::cmsRowForm('Picture 3', $inputPicture3.$picture3);
    }
    else{
        $picture3	            = '<img style="width:100%" id="display_image3" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture3'].'">';
        $rowPicture3 = Helper::cmsRowForm('Picture 3', $inputPicture3.$picture3.$inputPicture3Hidden);
    }

    if($this->arrayParam['form']['picture4'] == null)
        $rowPicture4 = Helper::cmsRowForm('Picture 4', $inputPicture4.$picture4);
    else{
        $picture4	            = '<img style="width:100%" id="display_image4" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture4'].'">';
        $rowPicture4 = Helper::cmsRowForm('Picture 4', $inputPicture4.$picture4.$inputPicture4Hidden);
    }
    if($this->arrayParam['form']['picture5'] == null)
        $rowPicture5 = Helper::cmsRowForm('Picture 5', $inputPicture5.$picture5);
    else{
        $picture5	            = '<img style="width:100%" id="display_image5" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture5'].'">';
        $rowPicture5 = Helper::cmsRowForm('Picture 5', $inputPicture5.$picture5.$inputPicture5Hidden);
    }

    if($this->arrayParam['form']['picture6'] == null)
        $rowPicture6 = Helper::cmsRowForm('Picture 6', $inputPicture6.$picture6);
    else{
        $picture6	            = '<img style="width:100%" id="display_image6" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture6'].'">';
        $rowPicture6 = Helper::cmsRowForm('Picture 6', $inputPicture6.$picture6.$inputPicture6Hidden);
    }

    if($this->arrayParam['form']['picture7'] == null)
        $rowPicture7 = Helper::cmsRowForm('Picture 7', $inputPicture7.$picture7);
    else{
        $picture7	            = '<img style="width:100%" id="display_image7" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture7'].'">';
        $rowPicture7 = Helper::cmsRowForm('Picture 7', $inputPicture7 . $picture7 . $inputPicture7Hidden);
    }

    if($this->arrayParam['form']['picture8'] == null)
        $rowPicture8 = Helper::cmsRowForm('Picture 8', $inputPicture8.$picture8);
    else{
        $picture8	            = '<img style="width:100%" id="display_image8" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture8'].'">';
        $rowPicture8 = Helper::cmsRowForm('Picture 8', $inputPicture8 . $picture8 . $inputPicture8Hidden);
    }

    if($this->arrayParam['form']['picture9'] == null)
        $rowPicture9 = Helper::cmsRowForm('Picture 9', $inputPicture9.$picture9);
    else{
        $picture9	            = '<img style="width:100%" id="display_image9" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture9'].'">';
        $rowPicture9 = Helper::cmsRowForm('Picture 9', $inputPicture9 . $picture9 . $inputPicture9Hidden);
    }

    if($this->arrayParam['form']['picture10'] == null)
        $rowPicture10 = Helper::cmsRowForm('Picture 10', $inputPicture10.$picture10);
    else{
        $picture10	            = '<img style="width:100%" id="display_image10" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture10'].'">';
        $rowPicture10 = Helper::cmsRowForm('Picture 10', $inputPicture10 . $picture10 . $inputPicture10Hidden);
    }

    if($this->arrayParam['form']['picture11'] == null)
        $rowPicture11 = Helper::cmsRowForm('Picture 11', $inputPicture11.$picture11);
    else{
        $picture11	            = '<img style="width:100%" id="display_image11" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture11'].'">';
        $rowPicture11 = Helper::cmsRowForm('Picture 11', $inputPicture11 . $picture11 . $inputPicture11Hidden);
    }

    if($this->arrayParam['form']['picture12'] == null)
        $rowPicture12 = Helper::cmsRowForm('Picture 12', $inputPicture12.$picture12);
    else{
        $picture12	            = '<img style="width:100%" id="display_image12" src="'.UPLOAD_URL . 'product/' . $this->arrayParam['form']['name'] . DS . $this->arrayParam['form']['picture12'].'">';
        $rowPicture12 = Helper::cmsRowForm('Picture 12', $inputPicture12 . $picture12 . $inputPicture12Hidden);
    }

    // MESSAGE
    $message	= Session::get('message');
    Session::delete('message');
    $strMessage = Helper::cmsMessage($message);


    // Save
    $linkSave                   = URL::createLink('admin', $controller, 'form', array('type' => 'save'));
    $btnSave                    = Helper::cmsButton('Save', 'toolbar-apply', $linkSave, null, 'submit');

    // Save & Close
    $linkSaveClose              = URL::createLink('admin', $controller, 'form', array('type' => 'save-close'));
    $btnSaveClose               = Helper::cmsButton('Save & Close', 'toolbar-save', $linkSaveClose, null, 'submit');

    // Save & New
    $linkSaveNew                = URL::createLink('admin', $controller, 'form', array('type' => 'save-new'));
    $btnSaveNew                 = Helper::cmsButton('Save & New', 'toolbar-save-new', $linkSaveNew, null, 'submit');

    // Cancel
    $linkCancel                 = URL::createLink('admin', $controller, 'index');
    $btnCancel                  = Helper::cmsButton('Cancel', 'toolbar-cancel', $linkCancel, null);

?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div id="system-message-container"><?php echo $strMessage . $this->error;?></div>
        <form action="#" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><?php echo $this->_title?></div>
                        <hr>
                        <?php echo $rowName . $rowPrice . $rowStock . $rowDescription . $rowSaleOff . $rowOrdering . $rowStatus . $rowSpecial . $rowCategory . $rowCollection . $rowDesigner . $rowID; ?>
                         <div class="form-group">
                            <label>Gif 360<sup>o</sup></label>
                            <input  type="file" name="gif[]" id="gif" class="inputbox form-control" multiple>
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12" style="width: 100%">
                <div class="card">
                    <div class="card-body row" style="justify-content: center">
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture1 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture2 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture3 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture4 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture5 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture6 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture7 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture8 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture9 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture10 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture11 ?></div>
                        <div class="col-lg-6 col-sm-6"><?php echo $rowPicture12 ?></div>
                        <div>
                            <?php echo $inputToken; ?>
                        </div>
                        <div class="form-group" >
                            <div class="row">
                                <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                    <?php echo $btnSave;?>
                                </div>
                                <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                    <?php echo $btnSaveClose;?>
                                </div>
                                <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                    <?php echo $btnSaveNew;?>
                                </div>
                                <div class="col-xl-6 col-sm-6 icon mb-3" style="width: 50%">
                                    <?php echo $btnCancel;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- End container-fluid-->
    </div><!--End content-wrapper-->
</div>
<script>
<?php
for($i = 1; $i <= 12; $i++){
    $script .= '
            const   picture'.$i.'     = document.querySelector("#picture'.$i.'");
            var     upload_image'.$i.'    = "";

            picture'.$i.'.addEventListener("change", function () {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    upload_image'.$i.' = reader.result;
                    document.querySelector("#display_image'.$i.'").src = `${upload_image'.$i.'}`;
                });
                reader.readAsDataURL(this.files[0]);
            });
        ';
}
echo $script
?>
ClassicEditor
    .create( document.querySelector( '#editor1' ) )
    .catch( error => {
        console.error( error );
    } );

</script>
<script>
        // This sample still does not showcase all CKEditor&nbsp;5 features (!)
        // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing', '|',
                    'lineHeight'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph', color: 'black' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1', color: 'black' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2', color: 'black' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3', color: 'black' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4', color: 'black' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5', color: 'black' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6', color: 'black' }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            lineHeight: {
                options: [1,2,3,4],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
        });
        function inputChange(){
            const value = $( "#price" ).val();
            $( "input#price" ).val( Intl.NumberFormat().format(Number(value.replaceAll(',', ''))) )
        }

    </script>


