<div class="form">

    <?php
    $form = $this->beginWidget('GxActiveForm', array(
                'id' => 'doc-form',
                'enableAjaxValidation' => false,
            ));


    //list of Controlled values are set in local.php or main in /protected/config
    $titleType = Yii::app()->params->titleType;
    $contributorType = Yii::app()->params->contributorType;
    $dateType = Yii::app()->params->dateType;
    $resourceType = Yii::app()->params->resourceType;
    $relatedIdentifierType = Yii::app()->params->relatedIdentifierType;
    $relationType = Yii::app()->params->relationType;
    $descriptionType = Yii::app()->params->descriptionType;
    $identifierScheme = Yii::app()->params->identifierScheme;
    ?>



    <?php echo $form->errorSummary($model); ?>
    <div class="basic">
        <p class="note">
            <?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
        </p>
        <div class="row">
            <span class="inputTitle" id="htitle">Title <span class="required">*</span> <img src="<?php echo Yii::app()->theme->baseUrl . '/images/help.png'; ?>" width="16" height="16"></span>
            <div class="help" id="help-htitle">This is the title of your dataset or collection. Please specify at least one main title.</div>
            <table class="tableForm indent"  id="titleRow">
                <tr><th> </th>
                    <th>Type </th>
                    <th></th>
                </tr>
               
                <?php
                if (count($model->title) == 0)
                {
                    $c = 1;
                }
                else
                {
                    $c = count($model->title);
                }

                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="titleTemplateRow" ><td>
                     <?php echo $form->textField($model, 'title[' . $i . '][@value]', array('id' => 'title_name-' . $i)); ?>
                    </td><td>
                        <?php echo $form->dropDownList($model, 'title[' . $i . '][@attributes][titleType]', $titleType); ?>
                    </td>
                    <td>
                        <?php
                        if ($i == 0)
                        {
                            echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'title\')'));
                        }
                        else
                        {
                            echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                        }
                        ?>
                     </td>
                 </tr>
                 <?php } ?>
           </table>

        </div><!-- row -->


        <div class="row">
            <?php echo $form->labelEx($model, 'doc_url'); ?>
            <?php echo $form->textField($model, 'doc_url', array('maxlength' => 256)); ?>
            <?php echo $form->error($model, 'doc_url'); ?>
        </div><!-- row -->
            <span class="inputTitle">Data Creator</span>
        <div class="row">
            <table class="tableForm"  id="creatorRow">
                <tr><th> Creator Family Name <span class="required">*</span></th>
                    <th> Creator Given Name <span class="required">*</span></th>
                    <th> Identifier </th>
                    <th> Identifier Scheme</th>
                </tr>
                <?php
                if (count($model->creator) == 0)
                {
                    $c = 1;
                }
                else
                {
                    $c = count($model->creator);
                }

                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="creatorTemplateRow" ><td>
                        <?php echo $form->textField($model, 'creator[' . $i . '][creatorName][@value]', array('id' => 'creator_name-' . $i)); ?>
                    </td><td>
                        <?php echo $form->textField($model, 'creator[' . $i . '][givenName][@value]', array('id' => 'given_name-' . $i)); ?>
                    </td><td>
                       <?php echo $form->dropDownList($model, 'creator[' . $i . '][nameIdentifier][@attributes][nameIdentifierScheme]',$identifierScheme); ?>
                    </td><td>
                        <?php echo $form->textField($model, 'creator[' . $i . '][nameIdentifier][@value]', array('id' => 'creator_nameIdentifier-' . $i)); ?>
                    </td><td>
                <?php
                        if ($i == 0)
                        {
                           echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'creator\')'));
                        }
                        else
                        {
                           echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                        }
                ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div><!-- row -->
        <div class="row">
                <?php echo $form->labelEx($model, 'publisher'); ?>
                <?php echo $form->textField($model, 'publisher', array('size' => 50)); ?>
                <?php echo $form->error($model, 'publisher'); ?>
        </div><!-- row -->
        <div class="row">
                <?php echo $form->labelEx($model, 'publicationYear'); ?>
                <?php echo $form->textField($model, 'publicationYear', array('maxlength' => 4, 'size' => 10)); ?>
                <?php echo $form->error($model, 'publicationYear'); ?>
        </div><!-- row -->
    </div>
    <br/>
    <h3 id="OptionalData" style="background: -moz-linear-gradient(center top , #EDEDED 5%, #DFDFDF 100%) repeat scroll 0 0 #EDEDED;
    border: 1px solid #DCDCDC;
    border-radius: 6px 6px 6px 6px;
    box-shadow: 0 1px 0 0 #DCDCDC inset;
    color: #666666;
    display: inline-block;
    font-family: arial;
    font-size: 15px;
    font-weight: bold;
    padding: 6px 24px;
    text-decoration: none;
    text-shadow: 1px 1px 0 #FFFFFF;">Optional Data</h3>
    <div class="advanced">
            <div class="row">
                <table class="tableForm"  id="subjectRow">
                    <tr><th>Subject <span class="required"></span></th>
                        <th> Subject Scheme </th>
                        <th></th>
                    </tr>
                    <?php
                    if (count($model->subject) == 0)
                    {
                        $c = 1;
                    }
                    else
                    {
                        $c = count($model->subject);
                    }

                    for ($i = 0; $i < $c; $i++)
                    {
                    ?>
                    <tr id="subjectTemplateRow" ><td>
                        <?php echo $form->textField($model, 'subject[' . $i . '][@value]', array('id' => 'subject_name-' . $i)); ?>
                         </td><td>
                        <?php echo $form->textField($model, 'subject[' . $i . '][@attributes][subjectScheme]', array('id' => 'subject_scheme-' . $i)); ?>
                        </td><td>
                        <?php
                        if ($i == 0)
                        {
                            echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'subject\')'));
                        }
                        else
                        {
                            echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                        }
                        ?>
                            </td>
                    </tr>
                    <?php } ?>
                </table>
            </div><!-- row -->

            <div class="row">
                <table class="tableForm"  id="contributorRow">
                    <tr><th> Contributor Type </th>
                        <th> Name (Last,First) </th>
                        <th> Name Identifier Scheme</th>
                        <th> Name Identifier  </th>
                        <th> </th>
                    </tr>
                    <?php
                    if (count($model->contributor) == 0)
                    {
                        $c = 1;
                    }
                    else
                    {
                        $c = count($model->contributor);
                    }

                    for ($i = 0; $i < $c; $i++)
                    {
                    ?>
                    <tr id="contributorTemplateRow" ><td>
                        <?php echo $form->dropDownList($model, 'contributor[' . $i . '][@attributes][contributorType]', $contributorType); ?>
                        </td><td>
                        <?php echo $form->textField($model, 'contributor[' . $i . '][contributorName][@value]', array('id' => 'contributor_name-' . $i)); ?>
                        </td><td>
                        <?php echo $form->dropDownList($model, 'contributor[' . $i . '][nameIdentifier][@attributes][nameIdentifierScheme]',$identifierScheme); ?>
                        </td><td>
                        <?php echo $form->textField($model, 'contributor[' . $i . '][nameIdentifier][@value]', array('id' => 'contributor_nameIdentifier-' . $i)); ?>
                        </td><td>
                        <?php
                            if ($i == 0)
                            {
                                echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'contributor\')'));
                            }
                            else
                            {
                                echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                            }
                          ?>
                        </td>
                    </tr>
                    <?php } ?>
            </table>

        </div><!-- row -->

        <div class="row">
             <span class="inputTitle" id="hdate"">Date <span class="required">*</span> <img src="<?php echo Yii::app()->theme->baseUrl . '/images/help.png'; ?>" width="16" height="16"></span>
             <div class="help" id="help-hdate">You can specify dates under the <a href="http://www.w3.org/TR/NOTE-datetime" target="_new">W3CDTF</a> format. <br/>If you like to enter a date outside of the YYYY-MM-DD format, you can manually type in  your date.<br/>For more Date Type definitions, <?php echo CHtml::link('please follow this link', array('site/page', 'view' => 'glossary'), array('target' => '_new')); ?></div>
            
            <table class="tableForm indent"  id="dateRow">
                <tr><th>   </th>
                    <th>Date Type</th>
                    <th></th>
                </tr>
                <?php
                if (count($model->date) == 0)
                {
                    $c = 1;
                }
                else
                {
                    $c = count($model->date);
                }

                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="dateTemplateRow" ><td>
                      <?php echo $form->textField($model, 'date[' . $i . '][@value]', array('maxlength' => 20, 'size' => 10,'class' => 'calendar')); ?>
                       
                      </td>
                      <td>
                      <?php echo $form->dropDownList($model, 'date[' . $i . '][@attributes][dateType]', $dateType); ?>
                      </td>
                      <td>
                      <?php
                        if ($i == 0)
                        {
                            echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'date\')'));
                        }
                        else
                        {
                            echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                        }
                      ?>
                      </td>
                 </tr>
                <?php } ?>
           </table>
        </div><!-- row -->
        <div class="row">
                <?php echo $form->labelEx($model, 'Language (eng, fre, get)'); ?>
                <?php echo $form->textField($model, 'language', array('maxlength' => 20, 'size' => 10)); ?>
        </div><!-- row -->
        <div class="row">
           <table class="tableForm"  id="resourceRow">
               <tr><th>Resource Type </th>
                   <th>Resource Type General </th>
               </tr>
               <tr id="resourceRow" ><td>
                        <?php echo $form->textField($model, 'resourceType[@value]', array('id' => 'resource_name-' . $i)); ?>
                    </td><td>
                        <?php echo $form->dropDownList($model, 'resourceType[@attributes][resourceTypeGeneral]', $resourceType); ?>
                    </td>
               </tr>
          </table>

        </div><!-- row -->
        <div class="row">
            <table class="tableForm"  id="alternateIdentifierRow">
                <tr><th>Alternate Identifier </th>
                    <th>Alternate Identifier Type </th>
                    <th></th>
                </tr>
                <?php
                if (count($model->alternateIdentifier) == 0)
                {
                    $c = 1;
                }
                else
                {
                    $c = count($model->alternateIdentifier);
                }

                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="alternateIdentifierTemplateRow" ><td>
                        <?php echo $form->textField($model, 'alternateIdentifier[' . $i . '][@value]', array('id' => 'alternateIdentifier_name-' . $i)); ?>
                        </td><td>
                        <?php echo $form->dropDownList($model, 'alternateIdentifier[' . $i . '][@attributes][alternateIdentifierType]', $relationType, array('id' => 'alternateIdentifier_Type-' . $i)); ?>
                        </td>
                        <td>
                        <?php
                            if ($i == 0)
                            {
                                echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'alternateIdentifier\')'));
                            }
                            else
                            {
                                echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                            }
                        ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>

       </div><!-- row -->

       <div class="row">
            <table class="tableForm"  id="relatedIdentifierRow">
                <tr><th>Related Identifier </th>
                    <th>Related Identifier Type </th>
                    <th>Relation Type</th>
                    <th></th>
                </tr>
                <?php
                if (count($model->relatedIdentifier) == 0)
                {
                    $c = 1;
                }
                else
                {
                    $c = count($model->relatedIdentifier);
                }

                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="relatedIdentifierTemplateRow" ><td>
                    <?php echo $form->textField($model, 'relatedIdentifier[' . $i . '][@value]', array('id' => 'relatedIdentifier_name-' . $i)); ?>
                    </td><td>
                    <?php echo $form->dropDownList($model, 'relatedIdentifier[' . $i . '][@attributes][relatedIdentifierType]', $relatedIdentifierType, array('id' => 'relatedIdentifier_Type-' . $i)); ?>
                    </td><td>
                    <?php echo $form->dropDownList($model, 'relatedIdentifier[' . $i . '][@attributes][relationType]', $relationType, array('id' => 'relation_Type-' . $i)); ?>
                    </td><td>
                    <?php
                    if ($i == 0)
                    {
                        echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'relatedIdentifier\')'));
                    }
                    else
                    {
                        echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                    }
                    ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div><!-- row -->
        <div class="row">
            <table class="tableForm"  id="sizeRow">
                <tr><th>Size </th>
                    <th></th>
                </tr>
                <?php
                if (count($model->size) == 0)
                {
                    $c = 1;
                }
                else
                {
                    $c = count($model->size);
                }

                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="sizeTemplateRow" ><td>
                    <?php echo $form->textField($model, 'size[' . $i . '][@value]', array('id' => 'size_name-' . $i)); ?>
                    </td>
                    <td>
                      <?php
                        if ($i == 0)
                        {
                            echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'size\')'));
                        }
                        else
                        {
                            echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                        }
                      ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div><!-- row -->
        <div class="row">
            <table class="tableForm"  id="formatRow">
                <tr><th>Format </th>
                    <th></th>
                </tr>
                <?php
                if (count($model->format) == 0)
                {
                    $c = 1;
                }
                else
                {
                    $c = count($model->format);
                }

                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="formatTemplateRow" ><td>
                    <?php echo $form->textField($model, 'format[' . $i . '][@value]', array('id' => 'format_name-' . $i)); ?>
                    </td>
                    <td>
                    <?php
                    if ($i == 0)
                    {
                        echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'format\')'));
                    }
                    else
                    {
                        echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                    }
                    ?>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </div><!-- row -->

        <div class="row">
            <?php echo $form->labelEx($model, 'Version'); ?>
            <?php echo $form->textField($model, 'version', array('maxlength' => 20, 'size' => 10)); ?>
        </div><!-- row -->
        <div class="row">
        <?php echo $form->labelEx($model, 'Rights'); ?>
        <?php echo $form->textArea($model, 'rights', array('rows' => 6, 'cols' => 40)); ?>
        </div><!-- row -->
        <div class="row">
            <table class="tableForm"  id="descriptionRow">
                <tr><th>Description </th>
                    <th>Description Type</th>
                    <th></th>
                </tr>
                <?php
                if (count($model->description) == 0)
                {
                    $c = 1;
                }
                else
                {
                    $c = count($model->description);
                }

                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="descriptionTemplateRow" >
                    <td>
                    <?php echo $form->textArea($model, 'description[' . $i . '][@value]', array('rows' => 6, 'cols' => 40, 'id' => 'description_name-' . $i)); ?>
                    </td>
                    <td>
                    <?php echo $form->dropDownList($model, 'description[' . $i . '][@attributes][descriptionType]', $descriptionType, array('id' => 'description_type-' . $i)); ?>
                    </td>
                    <td>
                    <?php
                    if ($i == 0)
                    {
                        echo CHtml::htmlButton('+', array('onClick' => 'addRow(\'description\')'));
                    }
                    else
                    {
                        echo CHtml::htmlButton('-', array('id' => 'DeleteBoxRow'));
                    }
                    ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div><!-- row -->
     </div>
<br/>
<?php
  echo GxHtml::submitButton('Save data only', array('name' => 'saveOnly'));
  echo '</br>';
  echo GxHtml::submitButton(Yii::t('app', 'Save and Send to ANDS Cite My Data'));
  $this->endWidget();
?>
</div><!-- form -->
