<div class="form">

    <?php
    $form = $this->beginWidget('GxActiveForm', array(
                'id' => 'doc-form',
                'enableAjaxValidation' => false,
            ));

	$facilityArray = explode('<br/>', $this->user['facility']);
	$searchCriteria = '';
	for ($c = 0; $c < count($facilityArray); $c++)
	{
		$searchCriteria .= ' or facilities like \'%'.$facilityArray[$c].'%\'';
	}
	$searchCriteria = substr($searchCriteria, 3);
	
    $facilities = DocUrl::model()->findAllBySql('select url from tbl_url where ('.$searchCriteria.') and approved = \'Approved\' order by url');
	$regUrl = '';
	for ($c = 0; $c < count($facilities); $c++)
	{
		$regUrl .= $facilities[$c]['url'].'<br/>';
	}
//print_r($urlType);die();
    //list of Controlled values are set in local.php or main in /protected/config
    $titleType = Yii::app()->params->titleType;
    $contributorType = Yii::app()->params->contributorType;
    $dateType = Yii::app()->params->dateType;
    $resourceType = Yii::app()->params->resourceType;
    $forType = Yii::app()->params->forType;
    $relatedIdentifierType = Yii::app()->params->relatedIdentifierType;
    $relationType = Yii::app()->params->relationType;
    $descriptionType = Yii::app()->params->descriptionType;
    $identifierScheme = Yii::app()->params->identifierScheme;
    ?>



    <?php echo $form->errorSummary($model); ?>
    <div class="basic">
        <p class="note">
            <?= Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required') ?>.
        </p>
        <div class="row">
            <span class="inputTitle" id="htitle">Title <span class="required">*</span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-htitle">A name or title by which a resource is known.</div>
            <table class="tableForm"  id="titleRow">
                <tr>
                    <th>Type </th>
                    <th>Name </th>
                    <th></th>
                </tr>
               
                <?php
                $c = (count($model->title) == 0)? 1 : count($model->title);
                for ($i = 0; $i < $c; $i++)
                {
					$model->title[$i]['@value'] = (isset($model->title[$i]['@value']))? html_entity_decode($model->title[$i]['@value'],ENT_COMPAT,'UTF-8'):'';
                ?>
                <tr id="titleTemplateRow" >
                    <td>
                        <?= $form->dropDownList($model, 'title[' . $i . '][@attributes][titleType]', $titleType) ?>
                    </td>
                    <td>
                        <?= $form->textField($model, 'title[' . $i . '][@value]', array('id' => 'title_name-' . $i)) ?>
                    </td>
                    <td>
                        <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'title\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                     </td>
                 </tr>
                 <?php 
				 } 
				 ?>
           </table>

        </div><!-- row -->


		<div class="row">
            <span class="inputTitle" id="hdocUrl">Dataset landing page <span class="required">*</span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-hdocUrl">
				URL where the minted doi will resolve to. The url must fall within the top level domain(s) you have registered with your Cite My Data account.
				<span class="inputTitle" id="hRegUrl"><img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
				<div class="help" id="help-hRegUrl"><?= $regUrl ?></div>
			</div>
            <div>
				<?= $form->textField($model, 'doc_url', array('maxlength' => 256, 'size' => 50)) ?>
                <?= $form->error($model, 'doc_url') ?>
				<script>
                    var urlTags = [
                    <?= '\''.str_replace('<br/>', '\',\'', $regUrl).'\'' ?>
                    ];
					$(function() {urlTags; 
						$('#Doc_doc_url').autocomplete({
							source:urlTags 
						});
					});
				</script>
            </div>
        </div><!-- row -->
            <span class="inputTitle" id="hcreator">Data Creator <span class="required">*</span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-hcreator">The main researchers involved in producing the data, or the authors of the publication, in priority order. May be a corporate/institutional or personal name. The personal name format should be: family, given. Non-roman names should be transliterated according to the ALA-LC schemes found at <a href="http://www.loc.gov/catdir/cpso/roman.html" target="_new">http://www.loc.gov/catdir/cpso/roman.html</a></div>

        <div class="row">
            <table class="tableForm"  id="creatorRow">
                <tr>
                    <?= (!$model->doc_doi)? '<th> Creator Last Name <span class="required">*</span></th><th> Creator First Name <span class="required">*</span></th>':'<th> Creator Name <span class="required">*</span><br/>(Last, First name)</th>' ?>
                    <th> Identifier Scheme</th>
                    <th> Identifier </th>
                </tr>
                <?php
                $c = (count($model->creator) == 0)? 1 : count($model->creator);
                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="creatorTemplateRow" ><td>
                        <?= $form->textField($model, 'creator[' . $i . '][creatorName][@value]', array('id' => 'creator_name-' . $i)) ?>
                    </td><td>
                        <?= (!$model->doc_status)? $form->textField($model, 'creator[' . $i . '][givenName][@value]', array('id' => 'given_name-' . $i)).'</td><td>':'' ?>
                        <?= $form->dropDownList($model, 'creator[' . $i . '][nameIdentifier][@attributes][nameIdentifierScheme]',$identifierScheme) ?>
                    </td><td>
                        <?= $form->textField($model, 'creator[' . $i . '][nameIdentifier][@value]', array('id' => 'creator_nameIdentifier-' . $i)) ?>
                    </td><td>
                        <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'creator\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                    </td>
                </tr>
                <?php 
                } 
                ?>
            </table>
        </div><!-- row -->

        <span class="inputTitle" id="hpublisher">Publisher <span class="required">*</span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
        <div class="help" id="help-hpublisher">The name of the entity that holds, archives, publishes, prints, distributes, releases, issues, or produces the resource. This property will be used to formulate the citation, so consider the prominence of the role.</div>
        <div class="row">
                <?= $form->textField($model, 'publisher', array('size' => 50)) ?>
                <?= $form->error($model, 'publisher') ?>
        </div><!-- row -->
        <span class="inputTitle" id="hpublicationYear">Publication Year <span class="required">*</span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
        <div class="help" id="help-hpublicationYear">Year when the data is made publicly available. If an embargo period has been in effect, use the date when the embargo period ends. If there is no standard publication year value, use the date that would be preferred from a citation perspective.</div>
        <div class="row">
                <?= $form->textField($model, 'publicationYear', array('maxlength' => 4, 'size' => 10)) ?>
                <?= $form->error($model, 'publicationYear') ?>
        </div><!-- row -->
    </div>
    <br/>
	<style type="text/css">
	.optional {
		-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
		-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
		box-shadow:inset 0px 1px 0px 0px #ffffff;
		background-color:#ededed;
		-moz-border-radius:6px;
		-webkit-border-radius:6px;
		border-radius:6px;
		border:1px solid #dcdcdc;
		display:inline-block;
		color:#444444;
		font-family:arial;
		font-size:15px;
		font-weight:bold;
		padding:6px 24px;
		text-decoration:none;
		text-shadow:1px 1px 0px #ffffff;
	}.optional:hover {
		background-color:#bfbfbf;
	}.optional:active {
		position:relative;
		top:1px;
	}
	/* This imageless css button was generated by CSSButtonGenerator.com */
	</style>
    <h3 id="OptionalData" class="optional" title="click to add additional metadata">Optional Metadata</h3>

    <div class="advanced">
            <div class="row">
                <span class="inputTitle" id="hsubject">Subject <span class="required"></span> <img src="<?php echo Yii::app()->theme->baseUrl . '/images/help.png'; ?>" width="16" height="16"></span>
                <div class="help" id="help-hsubject">Subject: Subject, keyword, classification code, or key phrase describing the resource.<br />Subject scheme: The name and/or URL of the Subject scheme or classification code, if one is used.</div>
                <table class="tableForm"  id="subjectRow">
                    <tr>
                        <th>Scheme </th>
                        <th>Subject </th>
                        <th></th>
                    </tr>
                    <?php
                    $c = (count($model->subject) == 0)? 1 : count($model->subject);
                    for ($i = 0; $i < $c; $i++)
                    {
                    ?>
                    <tr id="subjectTemplateRow" >
                        <td>
                            <?= $form->textField($model, 'subject[' . $i . '][@attributes][subjectScheme]', array('id' => 'subject_scheme-' . $i)) ?>
                        </td>
                        <td>
                            <?= $form->textField($model, 'subject[' . $i . '][@value]', array('id' => 'subject_name-' . $i, 'onfocus' => 'checkScheme(this.name)')) ?>
                        </td>
                        <td>
                            <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'subject\')')) :  CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                        </td>
                    </tr>
                    <?php 
                    } 
                    ?>
                </table>
                <script>
                    var availableTags = [
                    <?php
                        for ($i=0;$i<count($forType);$i++){
                            echo '\''.$forType[$i].'\',';
                        } 
                    ?>
                    ];

                    function checkScheme(objName){
                        row = document.getElementsByName(objName);
                        subjectCount = objName.split('][');
						subjectRow = subjectCount[1]; 
                        if (row[0].id == ''){
                            row[0].id = 'subject_name-' + subjectRow;
                        }
                        schemeValue = document.getElementsByName('Doc[subject]['+subjectRow+'][@attributes][subjectScheme]')[0].value;
                        if (schemeValue.trim().toUpperCase() == 'ANZSRC')
						{
                            autocomplete = "$(function() {availableTags; $('#subject_name-"+subjectRow+"').autocomplete({source:availableTags });});";
                            eval(autocomplete);
                            $('#subject_name-'+subjectRow).autocomplete( "option", "autoFocus", true );
                        }
						else
						{
                            $('#subject_name-'+subjectRow).autocomplete('disable');
						}
                    }
                </script>
            </div><!-- row -->

            <div class="row">
                <span class="inputTitle" id="hcontributor">Contributor <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
                <div class="help" id="help-hcontributor">The institution or person responsible for collecting, creating, or otherwise contributing to the development of the dataset. The personal name format should be: family, given. Non-roman names should be transliterated according to the ALA-LC schemes found at <a href="http://www.loc.gov/catdir/cpso/roman.html" target="_new">http://www.loc.gov/catdir/cpso/roman.html</a></div>
                <table class="tableForm"  id="contributorRow">
                    <tr><th> Contributor Type </th>
                        <th> Name (Last,First) </th>
                        <th> Name Identifier Scheme</th>
                        <th> Name Identifier  </th>
                        <th> </th>
                    </tr>
                    <?php
                    $c = (count($model->contributor) == 0)? 1 : count($model->contributor);
                    for ($i = 0; $i < $c; $i++)
                    {
                    ?>
                    <tr id="contributorTemplateRow" ><td>
                        <?= $form->dropDownList($model, 'contributor[' . $i . '][@attributes][contributorType]', $contributorType) ?>
                        </td><td>
                        <?= $form->textField($model, 'contributor[' . $i . '][contributorName][@value]', array('id' => 'contributor_name-' . $i)) ?>
                        </td><td>
                        <?= $form->dropDownList($model, 'contributor[' . $i . '][nameIdentifier][@attributes][nameIdentifierScheme]',$identifierScheme) ?>
                        </td><td>
                        <?= $form->textField($model, 'contributor[' . $i . '][nameIdentifier][@value]', array('id' => 'contributor_nameIdentifier-' . $i)) ?>
                        </td><td>
                        <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'contributor\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                        </td>
                    </tr>
                    <?php 
					} 
					?>
            </table>

        </div><!-- row -->

        <div class="row">
            <span class="inputTitle" id="hdate">Date <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-hdate">Different dates relevant to the work. YYYY or YYYY-MM-DD or any other format described in <a href="http://www.w3.org/TR/NOTE-datetime" target="_new">W3CDTF</a>. May be repeated to indicate a date range. To indicate a date period, provide two dates, specifying the StartDate and the EndDate. To indicate the end of an embargo period, use Available. To indicate the start of an embargo period, use Submitted or Accepted, as appropriate.</div>
            <table class="tableForm indent"  id="dateRow">
                <tr><th>   </th>
                    <th>Date Type</th>
                    <th></th>
                </tr>
                <?php
                $c = (count($model->date) == 0)? 1 : count($model->date);
                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="dateTemplateRow" ><td>
                      <?= $form->textField($model, 'date[' . $i . '][@value]', array('maxlength' => 20, 'size' => 10,'class' => 'calendar')) ?>
                       
                      </td>
                      <td>
                      <?= $form->dropDownList($model, 'date[' . $i . '][@attributes][dateType]', $dateType) ?>
                      </td>
                      <td>
                      <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'date\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                      </td>
                 </tr>
                <?php 
				} 
				?>
           </table>
        </div><!-- row -->

        <div class="row">
            <span class="inputTitle" id="hlanguage">Language <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-hlanguage">The primary language of the resource. Allowed values from: ISO 639-2/B, ISO 639-3 Examples: eng, fre, ger</div>
            <br />
                <?php /*echo $form->labelEx($model, 'Language (eng, fre, get)');*/ ?>
                <?= $form->textField($model, 'language', array('maxlength' => 20, 'size' => 10)); ?>
        </div><!-- row -->
        <div class="row">
            <span class="inputTitle" id="hresource">Rresource <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-hresource">A description of the resource. The format is open, but the preferred format is a single term of some detail so that a pair can be formed with the attribute. Example: Image/Animation, where 'Image' is resourceTypeGeneral value and 'Animation' is ResourceType value.</div>
            <table class="tableForm"  id="resourceRow">
               <tr>
                   <th>Resource Type General </th>
                   <th>Resource Type </th>
               </tr>
               <tr id="resourceRow" >
                    <td>
                        <?= $form->dropDownList($model, 'resourceType[@attributes][resourceTypeGeneral]', $resourceType) ?>
                    </td>
                    <td>
                        <?= $form->textField($model, 'resourceType[@value]', array('id' => 'resource_name-' . $i)) ?>
                    </td>
               </tr>
          </table>

        </div><!-- row -->
        <div class="row">
            <span class="inputTitle" id="halternateIdentifier">Alternate Identifier  <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-halternateIdentifier">An identifier or identifiers other than the primary Identifier applied to the resource being registered. This may be any alphanumeric string which is unique within its domain of issue.</div>
            <table class="tableForm"  id="alternateIdentifierRow">
                <tr><th>Alternate Identifier </th>
                    <th>Alternate Identifier Type </th>
                    <th></th>
                </tr>
                <?php
                $c = (count($model->alternateIdentifier) == 0)? 1 : count($model->alternateIdentifier);
                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="alternateIdentifierTemplateRow" ><td>
                        <?= $form->textField($model, 'alternateIdentifier[' . $i . '][@value]', array('id' => 'alternateIdentifier_name-' . $i)) ?>
                        </td><td>
                        <?= $form->dropDownList($model, 'alternateIdentifier[' . $i . '][@attributes][alternateIdentifierType]', $relatedIdentifierType, array('id' => 'alternateIdentifier_Type-' . $i)) ?>
                        </td>
                        <td>
                        <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'alternateIdentifier\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                        </td>
                    </tr>
                <?php 
				} 
				?>
            </table>

       </div><!-- row -->

       <div class="row">
            <span class="inputTitle" id="hrelatedIdentifier">Related Identifier <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-hrelatedIdentifier">Identifiers of related resources. Use this property to indicate subsets of properties, as appropriate. Description of the relationship of the resource being registered (A) and the related resource (B).</div>
            <table class="tableForm"  id="relatedIdentifierRow">
                <tr><th>Related Identifier </th>
                    <th>Related Identifier Type </th>
                    <th>Relation Type</th>
                    <th></th>
                </tr>
                <?php
                $c = (count($model->relatedIdentifier) == 0)? 1 : count($model->relatedIdentifier);
                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="relatedIdentifierTemplateRow" ><td>
                    <?= $form->textField($model, 'relatedIdentifier[' . $i . '][@value]', array('id' => 'relatedIdentifier_name-' . $i)) ?>
                    </td><td>
                    <?= $form->dropDownList($model, 'relatedIdentifier[' . $i . '][@attributes][relatedIdentifierType]', $relatedIdentifierType, array('id' => 'relatedIdentifier_Type-' . $i)) ?>
                    </td><td>
                    <?= $form->dropDownList($model, 'relatedIdentifier[' . $i . '][@attributes][relationType]', $relationType, array('id' => 'relation_Type-' . $i)) ?>
                    </td><td>
                    <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'relatedIdentifier\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                    </td>
                </tr>
                <?php 
				} 
				?>
            </table>
        </div><!-- row -->
        <div class="row">
            <span class="inputTitle" id="hsize">Size <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-hsize">Unstructured size information about the resource. Examples: "15 pages", "6 MB"</div>
            <table class="tableForm"  id="sizeRow">
                <!--tr><th>Size </th>
                    <th></th>
                </tr-->
                <?php
                $c = (count($model->size) == 0)? 1 : count($model->size);
                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="sizeTemplateRow" ><td>
                    <?= $form->textField($model, 'size[' . $i . '][@value]', array('id' => 'size_name-' . $i)) ?>
                    </td>
                    <td>
                      <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'size\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                    </td>
                </tr>
                <?php 
				} 
				?>
            </table>
        </div><!-- row -->
        <div class="row">
            <span class="inputTitle" id="hformat">Format <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png' ?>" width="16" height="16"></span>
            <div class="help" id="help-hformat">Technical format of the resource. Use file extension or MIME type where possible, e.g., PDF, XML, MPG or application/pdf, text/xml, video/mpeg.</div>
            <table class="tableForm"  id="formatRow">
                <?php
                $c = (count($model->format) == 0)? 1: count($model->format);
                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="formatTemplateRow" ><td>
                    <?= $form->textField($model, 'format[' . $i . '][@value]', array('id' => 'format_name-' . $i)) ?>
                    </td>
                    <td>
                    <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'format\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                    </td>
                </tr>
                <?php 
				} 
				?>
            </table>

        </div><!-- row -->

        <div class="row">
            <span class="inputTitle" id="hversion">Version <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png'; ?>" width="16" height="16"></span>
            <div class="help" id="help-hversion">The version number of the resource. If the primary resource has changed, the version number increases. Register a new DOI (or primary identifier) when the version of the resource changes to enable the citation of the exact version of a research dataset (or other resource).
May be used in conjunction with properties Alternate Identifier and Related Identifier to indicate various information updates.</div>
            <div>
                <?php /*echo $form->labelEx($model, 'Version');*/ ?>
                <?= $form->textField($model, 'version', array('maxlength' => 20, 'size' => 10)); ?>
            </div>
        </div><!-- row -->
        <div class="row">
            <span class="inputTitle" id="hrights">Rights <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png'; ?>" width="16" height="16"></span>
            <div class="help" id="help-hrights">Any rights information for this resource. Provide a rights management statement for the resource or reference a service providing such information. Include embargo information if applicable.</div>
            <div>
                <?php /*echo $form->labelEx($model, 'Rights');*/ ?>
                <?= $form->textArea($model, 'rights', array('rows' => 6, 'cols' => 40)); ?>
            </div>
        </div><!-- row -->
        <div class="row">
            <span class="inputTitle" id="hdescription">Description <span class="required"></span> <img src="<?= Yii::app()->theme->baseUrl . '/images/help.png'; ?>" width="16" height="16"></span>
            <div class="help" id="help-hdescription">All additional information that does not fit in any of the other categories. Use the type SeriesInformation when supplying the description of a resource that is part of a series. It is a best practice to supply a description.</div>
            <table class="tableForm"  id="descriptionRow">
                <tr><th></th>
                    <th>Description Type</th>
                    <th></th>
                </tr>
                <?php
                $c = (count($model->description) == 0)? 1 : count($model->description);
                for ($i = 0; $i < $c; $i++)
                {
                ?>
                <tr id="descriptionTemplateRow" >
                    <td>
                    <?= $form->textArea($model, 'description[' . $i . '][@value]', array('rows' => 6, 'cols' => 40, 'id' => 'description_name-' . $i)) ?>
                    </td>
                    <td>
                    <?= $form->dropDownList($model, 'description[' . $i . '][@attributes][descriptionType]', $descriptionType, array('id' => 'description_type-' . $i)) ?>
                    </td>
                    <td>
                    <?= ($i == 0)? CHtml::htmlButton('+', array('onClick' => 'addRow(\'description\')')) : CHtml::htmlButton('-', array('id' => 'DeleteBoxRow')) ?>
                    </td>
                </tr>
                <?php 
				} 
				?>
            </table>
        </div><!-- row -->
     </div>
<br/>
<?php
  echo GxHtml::submitButton('Save metadata only', array('name' => 'saveOnly'));
  echo '</br>';
  echo GxHtml::submitButton(Yii::t('app', 'Save and Send to ANDS Cite My Data'));
  $this->endWidget();
?>
</div><!-- form -->