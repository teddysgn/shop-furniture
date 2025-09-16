<?php
    class Helper {
        // create Button
        public static function cmsButton($name, $id, $link, $icon, $type = 'new', $return = false, $messgae = null) {
            $xhtml  = '';
            if($type == 'new') {
                $xhtml .= '<a id="' . $id . '" href="'.$link.'" class="btn btn-light btn-round mr-1"><i class="' . $icon . '"></i>'.$name.'</a>';
            } elseif ($type == 'submit') {
                $xhtml .= '<a id="' . $id . '"';
                if($return == true)
                    $xhtml .= 'onclick="javascript:geek(\''.$link.'\', \''.$messgae.'\')"';
                $xhtml .= 'onclick="javascript:submitForm(\''.$link.'\');"  class="btn btn-light btn-round mr-1"><i class="' . $icon . '"></i>'.$name.'</a>';
            }
            $xhtml .= '</li>';
            return $xhtml;
        }

        // create Icon Status
        public static function cmsStatus($statusValue, $link, $id){
            $strStatus = ($statusValue == 0) ? 'fa-solid fa-xmark' : 'fa-solid fa-check';

            $xhtml		= '<a class="jgrid" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\');">
							<span class="state '.$strStatus.'"></span>
						</a>';
            return $xhtml;
        }

        public static function cmsOther($statusValue, $link, $id){
            $strStatus = ($statusValue == 0) ? 'fa-solid fa-xmark' : 'fa-solid fa-check';

            $xhtml		= '<a class="jgrid" id="status-'.$id.'" href="javascript:changeOther(\''.$link.'\');">
							<span class="state '.$strStatus.'"></span>
						</a>';
            return $xhtml;
        }

        // create Icon Special
        public static function cmsSpecial($StatusValue, $link, $id){
            $strStatus = ($StatusValue == 0) ? 'fa-solid fa-xmark' : 'fa-solid fa-check';

            $xhtml		= '<a class="jgrid" id="special-'.$id.'" href="javascript:changeSpecial(\''.$link.'\');">
							<span class="state '.$strStatus.'"></span>
						</a>';
            return $xhtml;
        }

        // create Icon Completed
        public static function cmsCompleted($completedValue, $link, $id){
            $strCompleted = ($completedValue == 0) ? 'fa-solid fa-xmark' : 'fa-solid fa-check';

            $xhtml		= '<a class="jgrid" id="completed-'.$id.'" href="javascript:changeCompleted(\''.$link.'\');">
							<span class="state '.$strCompleted.'"></span>
						</a>';
            return $xhtml;
        }

        // create Icon Group ACP
        public static function cmsGroupACP($groupACPValue, $link, $id){
            if($groupACPValue == 0)
                $strGroupACP = 'fa-solid fa-xmark';
            elseif($groupACPValue == 1)
                $strGroupACP = 'fa-solid fa-check';
            else
                $strGroupACP = 'fa-solid fa-circle-dot';

            $xhtml		= '<a class="jgrid" id="group-acp-'.$id.'" href="javascript:changeGroupACP(\''.$link.'\');">
							<span class="state '.$strGroupACP.'"></span>
						</a>';
            return $xhtml;
        }
        
        // create Icon Cancel
        public static function cmsCancel($cancelValue, $link, $id){
            if($cancelValue == 0){
                 $xhtml		= '<a><span class="state fa-solid fa-xmark opacity"></span></a>';
            } elseif($cancelValue == 2){
                 $xhtml		= '<a><span class="state fa-solid fa-check opacity"></span></a>';
            } else {
                 $xhtml		= '<a class="jgrid fa-solid fa-circle-dot" id="cancel-'.$id.'" href="javascript:changeCancel(\''.$link.'\');">
							        
						       </a>';
            }
            return $xhtml;
        }


        // create Title
        public static function cmsLinkSort($name, $column, $comlumnPost, $orderPost){
            $img = '';
            $order	= ($orderPost == 'desc') ? 'asc' : 'desc';
            if($column == $comlumnPost) {
                $img = '&nbsp;<img src ="'.TEMPLATE_URL. 'admin\main\images\sort_'.$orderPost.'.png" alt="">';
            }
            $xhtml = '<a href="#" onclick="javascript:sortList(\''.$column.'\',\''.$order.'\')">'.$name.$img.'</a>';
            return $xhtml;
        }

        // create Selectbox
        public static function cmsSelectbox($name, $class, $arrValue, $keySelect = 'default', $style = null){
            $xhtml  = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'">';
            foreach($arrValue as $key => $value) {
                if($key == $keySelect){
                    $xhtml .= '<option selected="selected" value="'.$key.'">'.$value.'</option>';
                } else {
                    $xhtml .= '<option class="dropdown-item" value="'.$key.'">'.$value.'</option>';
                }
            }
            $xhtml .= '</select>';
            return $xhtml;
        }

        // create Input
        public static function cmsInput($type, $name, $id, $value, $class = null, $size = null, $readonly = null, $placeholder = null, $attribute = null){
            $strSize	=	($size==null) ? '' : "size='$size'";
            $strClass	=	($class==null) ? '' : "class='$class'";

            $xhtml = "<input $readonly type='$type' name='$name' id='$id' value='$value' placeholder='$placeholder' $attribute $strClass $strSize>";
            return $xhtml;
        }

        // create Row - ADMIN
        public static function cmsRowForm($lblName, $input, $require = false){
            $strRequired = '';

            if($require == true)
                $strRequired = '<span class="star">&nbsp;*</span>';
            $xhtml  = '<div class="form-group">
                            <label>'.$lblName.$strRequired.'</label>
                            '.$input.'
                        </div>';
            return $xhtml;
        }

        // create Row - PUBLIC
        public static function cmsRow($lblName, $input, $submit = false){
            if($submit == false) {
                $xhtml  = '<div class="form_row">
                            <label class="contact"><strong>'.$lblName.'</strong></label>
                            '.$input.'
                        </div>';
            } else {
                $xhtml  = '<div class="form_row">
                            '.$input.'
                        </div>';
            }

            return $xhtml;
        }

        // Create Message
        public static function cmsMessage($message){
            $xhtml = '';
            if(!empty($message)){
                $xhtml = '<dl id="system-message">
							<dt class="'.$message['class'].'">'.ucfirst($message['class']).'</dt>
							<dd class="'.$message['class'].' message">
								<ul>
									<li>'.$message['content'].'</li>
								</ul>
							</dd>
						</dl>';
            }
            return $xhtml;
        }
        
        // Create Message
        public static function cmsMessagePublic($message){
            $xhtml = '';
            if(!empty($message)){
                $xhtml = '<dl id="system-message">
							<dt class="'.$message['class'].'">'.ucfirst($message['class']).'</dt>
							<dd class="'.$message['class'].'" style="text-indent: 0px;">
								<ul>
									<li>'.$message['content'].'</li>
								</ul>
							</dd>
						</dl>';
            }
            return $xhtml;
        }

        // format date
        public static function formatDate($format, $value) {
            $result = '';
            if(!empty($value) &&  $value != '0000-00-00') {
                $result = date($format, strtotime($value));
            }

            return $result;
        }
    }
