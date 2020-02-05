<?php $this->html()->js('jquery.ui.widget.js'); ?>
<?php $this->html()->js('jquery.iframe-transport.js'); ?>
<?php $this->html()->js('jquery.fileupload.js'); ?>
<?php $this->html()->js('upload.js'); ?>

<div class="content">
    <div class="document-container">
        <a class="info-link" href="<?php echo $this->html()->url('student/'.$student->id()); ?>"><h1><?php echo $student->first_name(); ?> <?php echo $student->name(); ?></h1></a>
        <div id="dropbox">
            <form id="upload" class="form-horizontal" method="post" action="<?php echo $this->html()->url('document/'.$student->id().'/upload'); ?>" enctype="multipart/form-data">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">Déposez vos fichiers ci-dessous</div>

                    </div>

                    <select id="doc-filter"  style="display: none" class="pull-right , doc-filter" name="documentType" id="documentType">
                        <?php  echo '<option value="50">Tous</option>'; ?>
                        <?php foreach($documentMeta as $documentMetaType): ?>
                            <optgroup label="<?php echo $documentMetaType->metatype(); ?>">
                                <?php  foreach ($documentTypes as $documentType): ?>
                                    <?php if($documentType->metatype() == $documentMetaType->metatype()) {?>
                                        <option value="<?php echo $documentType->id(); ?>"><?php echo $documentType->name(); ?></option>
                                    <?php } endforeach ?>
                            </optgroup>
                        <?php endforeach ?>
                    </select>

                    <!-- Sélectionner "Autre par défaut -> id 11 (je sais c'est un nombre magique et c'est mmaaaalllll) "  -->
                     <script>
                        $('select option[value="11"]').prop({defaultSelected: true});
                    </script>

                    <div id="documentMeta" style="display: none">
                        <?php
                        echo json_encode($documentMeta);
                        ?>

                    </div>

                    <div id="documentTypes" style="display: none">
                        <?php
                        echo json_encode($documentTypes);
                        ?>

                    </div>

                    <div class="widget-body no-border">
                        <input type="file" name="upl" multiple />
                        <input id="file-id" name="file-id" type="hidden" value="">
                        <input id="student" name="student" type="hidden" value="<?php echo $student->id(); ?>">

                        <div id="files-box" class="widget-tickets clearfix slimscrol">

                            <!--<div class="file span12">

                                <div class="file-info">
                                    <img class="pdf" src="http://localhost/img/pdf.png" alt="PDF"/>
                                    <span class="file-name">J-lanzro-TPI-JdT.pdf</span>
                                    <span class="file-size">59.3 Kb</span>
                                    <progress class="progress-bar progress progress-striped" value="0" min="0" max="100"></progress>
                                    <img class="status" src="http://localhost/img/cancel.png" alt="X" />
                                </div>

                                <div class="file-misc">
                                    <div class="span6">

                                        <div class="control-group">
                                            <label class="control-label">Visible par :</label>

                                            <div class="controls">
                                                <select name="security-1" class="big-input">
                                                    <option value="1">Elève</option>
                                                    <option value="2">Enseignant</option>
                                                    <option value="3">Maître de classe</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label">Description :</label>

                                            <div class="controls">
                                                <textarea class="uncheck big-input" name="description-1" cols="30" rows="10" required></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="span6">

                                        <div class="control-group">
                                            <label class="control-label">Type :</label>
                                            <div class="controls">
                                                <select name="type-1" class="big-input">
                                                    <option value="1">Bulettin trimestriel</option>
                                                    <option value="2">Enseignant</option>
                                                    <option value="2">Maître de classe</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <span class="time">04.06.2013 14:36</span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <input type="button" class="btn big-input" onClick="javascript:submit_form('1');" value="Confirmer">
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
