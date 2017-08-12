<?php

/* SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many.html.twig */
class __TwigTemplate_cc5b627f90d440c9fb484273a910718c45cf322791c34ef75ad9577f5c944df7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        if ( !$this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "hasassociationadmin", array())) {
            // line 12
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 13
                echo "        ";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement($context["element"], $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array())), "html", null, true);
                echo "
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 16
            echo "
    <div id=\"field_container_";
            // line 17
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" class=\"field-container\">
        <span id=\"field_widget_";
            // line 18
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "\" >
            ";
            // line 19
            if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "edit", array()) == "inline")) {
                // line 20
                echo "                ";
                if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "inline", array()) == "table")) {
                    // line 21
                    echo "                    ";
                    if ((twig_length_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array())) > 0)) {
                        // line 22
                        echo "                        <table class=\"table table-bordered\">
                            <thead>
                                <tr>
                                    ";
                        // line 25
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute(twig_first($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array())), "children", array()));
                        foreach ($context['_seq'] as $context["field_name"] => $context["nested_field"]) {
                            // line 26
                            echo "                                        ";
                            if (($context["field_name"] == "_delete")) {
                                // line 27
                                echo "                                            <th>";
                                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_delete", array(), "SonataAdminBundle"), "html", null, true);
                                echo "</th>
                                        ";
                            } else {
                                // line 29
                                echo "                                            <th ";
                                echo (($this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "required", array(), "array")) ? ("class=\"required\"") : (""));
                                if (($this->getAttribute($this->getAttribute($this->getAttribute($context["nested_field"], "vars", array(), "any", false, true), "attr", array(), "array", false, true), "hidden", array(), "array", true, true) && $this->getAttribute($this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "attr", array(), "array"), "hidden", array(), "array"))) {
                                    echo " style=\"display:none;\"";
                                }
                                echo ">
                                                ";
                                // line 30
                                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "sonata_admin", array(), "array"), "admin", array()), "trans", array(0 => $this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "label", array()), 1 => array(), 2 => $this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "translation_domain", array())), "method"), "html", null, true);
                                echo "
                                            </th>
                                        ";
                            }
                            // line 33
                            echo "                                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['field_name'], $context['nested_field'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 34
                        echo "                                </tr>
                            </thead>
                            <tbody class=\"sonata-ba-tbody\">
                                ";
                        // line 37
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()));
                        foreach ($context['_seq'] as $context["nested_group_field_name"] => $context["nested_group_field"]) {
                            // line 38
                            echo "                                    <tr>
                                        ";
                            // line 39
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["nested_group_field"], "children", array()));
                            foreach ($context['_seq'] as $context["field_name"] => $context["nested_field"]) {
                                // line 40
                                echo "                                            <td class=\"sonata-ba-td-";
                                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                                echo "-";
                                echo twig_escape_filter($this->env, $context["field_name"], "html", null, true);
                                echo " control-group";
                                if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "errors", array())) > 0)) {
                                    echo " error";
                                }
                                echo "\"";
                                if (($this->getAttribute($this->getAttribute($this->getAttribute($context["nested_field"], "vars", array(), "any", false, true), "attr", array(), "array", false, true), "hidden", array(), "array", true, true) && $this->getAttribute($this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "attr", array(), "array"), "hidden", array(), "array"))) {
                                    echo " style=\"display:none;\"";
                                }
                                echo ">
                                                ";
                                // line 41
                                if ($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "associationadmin", array(), "any", false, true), "formfielddescriptions", array(), "any", false, true), $context["field_name"], array(), "array", true, true)) {
                                    // line 42
                                    echo "                                                    ";
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'widget');
                                    echo "

                                                    ";
                                    // line 44
                                    $context["dummy"] = $this->getAttribute($context["nested_group_field"], "setrendered", array());
                                    // line 45
                                    echo "                                                ";
                                } else {
                                    // line 46
                                    echo "                                                    ";
                                    if (($context["field_name"] == "_delete")) {
                                        // line 47
                                        echo "                                                        ";
                                        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'widget', array("label_render" => false));
                                        echo "
                                                    ";
                                    } else {
                                        // line 49
                                        echo "                                                        ";
                                        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'widget');
                                        echo "
                                                    ";
                                    }
                                    // line 51
                                    echo "                                                ";
                                }
                                // line 52
                                echo "                                                ";
                                if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["nested_field"], "vars", array()), "errors", array())) > 0)) {
                                    // line 53
                                    echo "                                                    <div class=\"help-inline sonata-ba-field-error-messages\">
                                                        ";
                                    // line 54
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["nested_field"], 'errors');
                                    echo "
                                                    </div>
                                                ";
                                }
                                // line 57
                                echo "                                            </td>
                                        ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['field_name'], $context['nested_field'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 59
                            echo "                                    </tr>
                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['nested_group_field_name'], $context['nested_group_field'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 61
                        echo "                            </tbody>
                        </table>
                    ";
                    }
                    // line 64
                    echo "                ";
                } elseif ((twig_length_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array())) > 0)) {
                    // line 65
                    echo "                    ";
                    $context["associationAdmin"] = $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array());
                    // line 66
                    echo "
                    <div class=\"sonata-ba-tabs\">
                        ";
                    // line 68
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()));
                    $context['loop'] = array(
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    );
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["nested_group_field"]) {
                        // line 69
                        echo "                            <div>
                                <div class=\"nav-tabs-custom\">
                                    <ul class=\"nav nav-tabs\">
                                        ";
                        // line 72
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : null), "formgroups", array()));
                        $context['loop'] = array(
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        );
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
                            // line 73
                            echo "                                            <li class=\"";
                            if ($this->getAttribute($context["loop"], "first", array())) {
                                echo "active";
                            }
                            echo "\">
                                                <a href=\"#";
                            // line 74
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : null), "uniqid", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["loop"], "parent", array()), "loop", array()), "index", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                            echo "\" data-toggle=\"tab\">
                                                    <i class=\"icon-exclamation-sign has-errors hide\"></i>
                                                    ";
                            // line 76
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : null), "trans", array(0 => $context["name"], 1 => array(), 2 => $this->getAttribute($context["form_group"], "translation_domain", array())), "method"), "html", null, true);
                            echo "
                                                </a>
                                            </li>
                                        ";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['length'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 80
                        echo "                                    </ul>

                                    <div class=\"tab-content\">
                                        ";
                        // line 83
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : null), "formgroups", array()));
                        $context['loop'] = array(
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        );
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["name"] => $context["form_group"]) {
                            // line 84
                            echo "                                            <div class=\"tab-pane ";
                            if ($this->getAttribute($context["loop"], "first", array())) {
                                echo "active";
                            }
                            echo "\" id=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : null), "uniqid", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["loop"], "parent", array()), "loop", array()), "index", array()), "html", null, true);
                            echo "_";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                            echo "\">
                                                <fieldset>
                                                    <div class=\"sonata-ba-collapsed-fields\">
                                                        ";
                            // line 87
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["form_group"], "fields", array()));
                            foreach ($context['_seq'] as $context["_key"] => $context["field_name"]) {
                                // line 88
                                echo "                                                            ";
                                $context["nested_field"] = $this->getAttribute($this->getAttribute($context["nested_group_field"], "children", array()), $context["field_name"], array(), "array");
                                // line 89
                                echo "                                                            <div class=\"sonata-ba-field-";
                                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                                echo "-";
                                echo twig_escape_filter($this->env, $context["field_name"], "html", null, true);
                                echo "\">
                                                                ";
                                // line 90
                                if ($this->getAttribute($this->getAttribute((isset($context["associationAdmin"]) ? $context["associationAdmin"] : null), "formfielddescriptions", array(), "any", false, true), $context["field_name"], array(), "array", true, true)) {
                                    // line 91
                                    echo "                                                                    ";
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["nested_field"]) ? $context["nested_field"] : null), 'row', array("inline" => "natural", "edit" => "inline"));
                                    // line 94
                                    echo "
                                                                    ";
                                    // line 95
                                    $context["dummy"] = $this->getAttribute($context["nested_group_field"], "setrendered", array());
                                    // line 96
                                    echo "                                                                ";
                                } else {
                                    // line 97
                                    echo "                                                                    ";
                                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["nested_field"]) ? $context["nested_field"] : null), 'row');
                                    echo "
                                                                ";
                                }
                                // line 99
                                echo "                                                            </div>
                                                        ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_name'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 101
                            echo "                                                    </div>
                                                </fieldset>
                                            </div>
                                        ";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['length'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['name'], $context['form_group'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 105
                        echo "                                    </div>
                                </div>

                                ";
                        // line 108
                        if ($this->getAttribute($context["nested_group_field"], "_delete", array(), "array", true, true)) {
                            // line 109
                            echo "                                    ";
                            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["nested_group_field"], "_delete", array(), "array"), 'row');
                            echo "
                                ";
                        }
                        // line 111
                        echo "                            </div>
                        ";
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['length'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nested_group_field'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 113
                    echo "                    </div>
                ";
                }
                // line 115
                echo "            ";
            } else {
                // line 116
                echo "                ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'widget');
                echo "
            ";
            }
            // line 118
            echo "
        </span>

        ";
            // line 121
            if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "edit", array()) == "inline")) {
                // line 122
                echo "
            ";
                // line 123
                if (((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "hasroute", array(0 => "create"), "method") && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "isGranted", array(0 => "CREATE"), "method")) && (isset($context["btn_add"]) ? $context["btn_add"] : null)) && ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "options", array(), "any", false, true), "limit", array(), "any", true, true) || (twig_length_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array())) < $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "options", array()), "limit", array()))))) {
                    // line 124
                    echo "                <span id=\"field_actions_";
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                    echo "\" >
                    <a
                        href=\"";
                    // line 126
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "generateUrl", array(0 => "create", 1 => $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "getOption", array(0 => "link_parameters", 1 => array()), "method")), "method"), "html", null, true);
                    echo "\"
                        onclick=\"return start_field_retrieve_";
                    // line 127
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                    echo "(this);\"
                        class=\"btn btn-success btn-sm sonata-ba-action\"
                        title=\"";
                    // line 129
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["btn_add"]) ? $context["btn_add"] : null), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : null)), "html", null, true);
                    echo "\"
                        >
                        <i class=\"fa fa-plus-circle\"></i>
                        ";
                    // line 132
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["btn_add"]) ? $context["btn_add"] : null), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : null)), "html", null, true);
                    echo "
                    </a>
                </span>
            ";
                }
                // line 136
                echo "
            ";
                // line 138
                echo "            ";
                if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "options", array(), "any", false, true), "sortable", array(), "any", true, true)) {
                    // line 139
                    echo "                <script type=\"text/javascript\">
                    ";
                    // line 140
                    if (($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "inline", array()) == "table")) {
                        // line 141
                        echo "                        jQuery('div#field_container_";
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo " tbody.sonata-ba-tbody').sortable({
                            axis: 'y',
                            opacity: 0.6,
                            items: '> tr',
                            stop: apply_position_value_";
                        // line 145
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "
                        });

                        function apply_position_value_";
                        // line 148
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "() {
                            // update the input value position
                            jQuery('div#field_container_";
                        // line 150
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo " tbody.sonata-ba-tbody td.sonata-ba-td-";
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "options", array()), "sortable", array()), "html", null, true);
                        echo "').each(function(index, element) {
                                // remove the sortable handler and put it back
                                jQuery('span.sonata-ba-sortable-handler', element).remove();
                                jQuery(element).append('<span class=\"sonata-ba-sortable-handler ui-icon ui-icon-grip-solid-horizontal\"></span>');
                                jQuery('input', element).hide();
                            });

                            jQuery('div#field_container_";
                        // line 157
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo " tbody.sonata-ba-tbody td.sonata-ba-td-";
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "options", array()), "sortable", array()), "html", null, true);
                        echo " input').each(function(index, value) {
                                jQuery(value).val(index + 1);
                            });
                        }

                        // refresh the sortable option when a new element is added
                        jQuery('#sonata-ba-field-container-";
                        // line 163
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "').bind('sonata.add_element', function() {
                            apply_position_value_";
                        // line 164
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "();
                            jQuery('div#field_container_";
                        // line 165
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo " tbody.sonata-ba-tbody').sortable('refresh');
                        });

                        apply_position_value_";
                        // line 168
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "();
                    ";
                    } else {
                        // line 170
                        echo "                        jQuery('div#field_container_";
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo " .sonata-ba-tabs').sortable({
                            axis: 'y',
                            opacity: 0.6,
                            items: '> div',
                            stop: apply_position_value_";
                        // line 174
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "
                        });

                        function apply_position_value_";
                        // line 177
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "() {
                            // update the input value position
                            jQuery('div#field_container_";
                        // line 179
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo " .sonata-ba-tabs .sonata-ba-field-";
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "options", array()), "sortable", array()), "html", null, true);
                        echo "').each(function(index, element) {
                                // remove the sortable handler and put it back
                                var parent = jQuery(element).closest('.nav-tabs-custom');
                                var tabs = parent.find('> .nav-tabs');
                                jQuery('.sonata-ba-sortable-handler', tabs).remove();
                                \$('<li class=\"sonata-ba-sortable-handler pull-right\"></li>')
                                        .prepend('<span class=\"ui-icon ui-icon-grip-solid-horizontal\"></span>')
                                        .appendTo(tabs);
                                jQuery('input', element).hide();
                            });

                            jQuery('div#field_container_";
                        // line 190
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo " .sonata-ba-tabs .sonata-ba-field-";
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "-";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "options", array()), "sortable", array()), "html", null, true);
                        echo " input').each(function(index, value) {
                                jQuery(value).val(index + 1);
                            });
                        }

                        // refresh the sortable option when a new element is added
                        jQuery('#sonata-ba-field-container-";
                        // line 196
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "').bind('sonata.add_element', function() {
                            apply_position_value_";
                        // line 197
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "();
                            jQuery('div#field_container_";
                        // line 198
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo " .sonata-ba-tabs').sortable('refresh');
                        });

                        apply_position_value_";
                        // line 201
                        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                        echo "();
                    ";
                    }
                    // line 203
                    echo "                </script>
            ";
                }
                // line 205
                echo "
            ";
                // line 207
                echo "            ";
                $this->loadTemplate("SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_association_script.html.twig", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many.html.twig", 207)->display($context);
                // line 208
                echo "
        ";
            } else {
                // line 210
                echo "            <span id=\"field_actions_";
                echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                echo "\" >
                ";
                // line 211
                if (((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "hasroute", array(0 => "create"), "method") && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "isGranted", array(0 => "CREATE"), "method")) && (isset($context["btn_add"]) ? $context["btn_add"] : null)) && ( !$this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array(), "any", false, true), "options", array(), "any", false, true), "limit", array(), "any", true, true) || (twig_length_filter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array())) < $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "options", array()), "limit", array()))))) {
                    // line 212
                    echo "                    <a
                        href=\"";
                    // line 213
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "associationadmin", array()), "generateUrl", array(0 => "create", 1 => $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "field_description", array()), "getOption", array(0 => "link_parameters", 1 => array()), "method")), "method"), "html", null, true);
                    echo "\"
                        onclick=\"return start_field_dialog_form_add_";
                    // line 214
                    echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
                    echo "(this);\"
                        class=\"btn btn-success btn-sm sonata-ba-action\"
                        title=\"";
                    // line 216
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["btn_add"]) ? $context["btn_add"] : null), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : null)), "html", null, true);
                    echo "\"
                        >
                        <i class=\"fa fa-plus-circle\"></i>
                        ";
                    // line 219
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["btn_add"]) ? $context["btn_add"] : null), array(), (isset($context["btn_catalogue"]) ? $context["btn_catalogue"] : null)), "html", null, true);
                    echo "
                    </a>
                ";
                }
                // line 222
                echo "            </span>

            ";
                // line 224
                $this->loadTemplate("SonataDoctrineORMAdminBundle:CRUD:edit_modal.html.twig", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many.html.twig", 224)->display($context);
                // line 225
                echo "
            ";
                // line 226
                $this->loadTemplate("SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_association_script.html.twig", "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many.html.twig", 226)->display($context);
                // line 227
                echo "        ";
            }
            // line 228
            echo "    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_to_many.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  648 => 228,  645 => 227,  643 => 226,  640 => 225,  638 => 224,  634 => 222,  628 => 219,  622 => 216,  617 => 214,  613 => 213,  610 => 212,  608 => 211,  603 => 210,  599 => 208,  596 => 207,  593 => 205,  589 => 203,  584 => 201,  578 => 198,  574 => 197,  570 => 196,  557 => 190,  539 => 179,  534 => 177,  528 => 174,  520 => 170,  515 => 168,  509 => 165,  505 => 164,  501 => 163,  488 => 157,  474 => 150,  469 => 148,  463 => 145,  455 => 141,  453 => 140,  450 => 139,  447 => 138,  444 => 136,  437 => 132,  431 => 129,  426 => 127,  422 => 126,  416 => 124,  414 => 123,  411 => 122,  409 => 121,  404 => 118,  398 => 116,  395 => 115,  391 => 113,  376 => 111,  370 => 109,  368 => 108,  363 => 105,  346 => 101,  339 => 99,  333 => 97,  330 => 96,  328 => 95,  325 => 94,  322 => 91,  320 => 90,  313 => 89,  310 => 88,  306 => 87,  291 => 84,  274 => 83,  269 => 80,  251 => 76,  242 => 74,  235 => 73,  218 => 72,  213 => 69,  196 => 68,  192 => 66,  189 => 65,  186 => 64,  181 => 61,  174 => 59,  167 => 57,  161 => 54,  158 => 53,  155 => 52,  152 => 51,  146 => 49,  140 => 47,  137 => 46,  134 => 45,  132 => 44,  126 => 42,  124 => 41,  109 => 40,  105 => 39,  102 => 38,  98 => 37,  93 => 34,  87 => 33,  81 => 30,  73 => 29,  67 => 27,  64 => 26,  60 => 25,  55 => 22,  52 => 21,  49 => 20,  47 => 19,  43 => 18,  39 => 17,  36 => 16,  26 => 13,  21 => 12,  19 => 11,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* {% if not sonata_admin.field_description.hasassociationadmin %}*/
/*     {% for element in value %}*/
/*         {{ element|render_relation_element(sonata_admin.field_description) }}*/
/*     {% endfor %}*/
/* {% else %}*/
/* */
/*     <div id="field_container_{{ id }}" class="field-container">*/
/*         <span id="field_widget_{{ id }}" >*/
/*             {% if sonata_admin.edit == 'inline' %}*/
/*                 {% if sonata_admin.inline == 'table' %}*/
/*                     {% if form.children|length > 0 %}*/
/*                         <table class="table table-bordered">*/
/*                             <thead>*/
/*                                 <tr>*/
/*                                     {% for field_name, nested_field in form.children|first.children %}*/
/*                                         {% if field_name == '_delete' %}*/
/*                                             <th>{{ 'action_delete'|trans({}, 'SonataAdminBundle') }}</th>*/
/*                                         {% else %}*/
/*                                             <th {{ nested_field.vars['required']  ? 'class="required"' : '' }}{% if (nested_field.vars['attr']['hidden'] is defined) and (nested_field.vars['attr']['hidden']) %} style="display:none;"{% endif %}>*/
/*                                                 {{ nested_field.vars['sonata_admin'].admin.trans(nested_field.vars.label, {}, nested_field.vars.translation_domain) }}*/
/*                                             </th>*/
/*                                         {% endif %}*/
/*                                     {% endfor %}*/
/*                                 </tr>*/
/*                             </thead>*/
/*                             <tbody class="sonata-ba-tbody">*/
/*                                 {% for nested_group_field_name, nested_group_field in form.children %}*/
/*                                     <tr>*/
/*                                         {% for field_name, nested_field in nested_group_field.children %}*/
/*                                             <td class="sonata-ba-td-{{ id }}-{{ field_name  }} control-group{% if nested_field.vars.errors|length > 0 %} error{% endif %}"{% if (nested_field.vars['attr']['hidden'] is defined) and (nested_field.vars['attr']['hidden']) %} style="display:none;"{% endif %}>*/
/*                                                 {% if sonata_admin.field_description.associationadmin.formfielddescriptions[field_name] is defined %}*/
/*                                                     {{ form_widget(nested_field) }}*/
/* */
/*                                                     {% set dummy = nested_group_field.setrendered %}*/
/*                                                 {% else %}*/
/*                                                     {% if field_name == '_delete' %}*/
/*                                                         {{ form_widget(nested_field, {'label_render': false}) }}*/
/*                                                     {% else %}*/
/*                                                         {{ form_widget(nested_field) }}*/
/*                                                     {% endif %}*/
/*                                                 {% endif %}*/
/*                                                 {% if nested_field.vars.errors|length > 0 %}*/
/*                                                     <div class="help-inline sonata-ba-field-error-messages">*/
/*                                                         {{ form_errors(nested_field) }}*/
/*                                                     </div>*/
/*                                                 {% endif %}*/
/*                                             </td>*/
/*                                         {% endfor %}*/
/*                                     </tr>*/
/*                                 {% endfor %}*/
/*                             </tbody>*/
/*                         </table>*/
/*                     {% endif %}*/
/*                 {% elseif form.children|length > 0 %}*/
/*                     {% set associationAdmin = sonata_admin.field_description.associationadmin %}*/
/* */
/*                     <div class="sonata-ba-tabs">*/
/*                         {% for nested_group_field in form.children %}*/
/*                             <div>*/
/*                                 <div class="nav-tabs-custom">*/
/*                                     <ul class="nav nav-tabs">*/
/*                                         {% for name, form_group in associationAdmin.formgroups %}*/
/*                                             <li class="{% if loop.first %}active{% endif %}">*/
/*                                                 <a href="#{{ associationAdmin.uniqid }}_{{ loop.parent.loop.index }}_{{ loop.index }}" data-toggle="tab">*/
/*                                                     <i class="icon-exclamation-sign has-errors hide"></i>*/
/*                                                     {{ associationAdmin.trans(name, {}, form_group.translation_domain) }}*/
/*                                                 </a>*/
/*                                             </li>*/
/*                                         {% endfor %}*/
/*                                     </ul>*/
/* */
/*                                     <div class="tab-content">*/
/*                                         {% for name, form_group in associationAdmin.formgroups %}*/
/*                                             <div class="tab-pane {% if loop.first %}active{% endif %}" id="{{ associationAdmin.uniqid }}_{{ loop.parent.loop.index }}_{{ loop.index }}">*/
/*                                                 <fieldset>*/
/*                                                     <div class="sonata-ba-collapsed-fields">*/
/*                                                         {% for field_name in form_group.fields %}*/
/*                                                             {% set nested_field = nested_group_field.children[field_name] %}*/
/*                                                             <div class="sonata-ba-field-{{ id }}-{{ field_name }}">*/
/*                                                                 {% if associationAdmin.formfielddescriptions[field_name] is defined %}*/
/*                                                                     {{ form_row(nested_field, {*/
/*                                                                         'inline': 'natural',*/
/*                                                                         'edit'  : 'inline'*/
/*                                                                     }) }}*/
/*                                                                     {% set dummy = nested_group_field.setrendered %}*/
/*                                                                 {% else %}*/
/*                                                                     {{ form_row(nested_field) }}*/
/*                                                                 {% endif %}*/
/*                                                             </div>*/
/*                                                         {% endfor %}*/
/*                                                     </div>*/
/*                                                 </fieldset>*/
/*                                             </div>*/
/*                                         {% endfor %}*/
/*                                     </div>*/
/*                                 </div>*/
/* */
/*                                 {% if nested_group_field['_delete'] is defined %}*/
/*                                     {{ form_row(nested_group_field['_delete']) }}*/
/*                                 {% endif %}*/
/*                             </div>*/
/*                         {% endfor %}*/
/*                     </div>*/
/*                 {% endif %}*/
/*             {% else %}*/
/*                 {{ form_widget(form) }}*/
/*             {% endif %}*/
/* */
/*         </span>*/
/* */
/*         {% if sonata_admin.edit == 'inline' %}*/
/* */
/*             {% if sonata_admin.field_description.associationadmin.hasroute('create') and sonata_admin.field_description.associationadmin.isGranted('CREATE') and btn_add and ( sonata_admin.field_description.options.limit is not defined or form.children|length < sonata_admin.field_description.options.limit ) %}*/
/*                 <span id="field_actions_{{ id }}" >*/
/*                     <a*/
/*                         href="{{ sonata_admin.field_description.associationadmin.generateUrl('create', sonata_admin.field_description.getOption('link_parameters', {})) }}"*/
/*                         onclick="return start_field_retrieve_{{ id }}(this);"*/
/*                         class="btn btn-success btn-sm sonata-ba-action"*/
/*                         title="{{ btn_add|trans({}, btn_catalogue) }}"*/
/*                         >*/
/*                         <i class="fa fa-plus-circle"></i>*/
/*                         {{ btn_add|trans({}, btn_catalogue) }}*/
/*                     </a>*/
/*                 </span>*/
/*             {% endif %}*/
/* */
/*             {# add code for the sortable options #}*/
/*             {% if sonata_admin.field_description.options.sortable is defined %}*/
/*                 <script type="text/javascript">*/
/*                     {% if sonata_admin.inline == 'table' %}*/
/*                         jQuery('div#field_container_{{ id }} tbody.sonata-ba-tbody').sortable({*/
/*                             axis: 'y',*/
/*                             opacity: 0.6,*/
/*                             items: '> tr',*/
/*                             stop: apply_position_value_{{ id }}*/
/*                         });*/
/* */
/*                         function apply_position_value_{{ id }}() {*/
/*                             // update the input value position*/
/*                             jQuery('div#field_container_{{ id }} tbody.sonata-ba-tbody td.sonata-ba-td-{{ id }}-{{ sonata_admin.field_description.options.sortable }}').each(function(index, element) {*/
/*                                 // remove the sortable handler and put it back*/
/*                                 jQuery('span.sonata-ba-sortable-handler', element).remove();*/
/*                                 jQuery(element).append('<span class="sonata-ba-sortable-handler ui-icon ui-icon-grip-solid-horizontal"></span>');*/
/*                                 jQuery('input', element).hide();*/
/*                             });*/
/* */
/*                             jQuery('div#field_container_{{ id }} tbody.sonata-ba-tbody td.sonata-ba-td-{{ id }}-{{ sonata_admin.field_description.options.sortable }} input').each(function(index, value) {*/
/*                                 jQuery(value).val(index + 1);*/
/*                             });*/
/*                         }*/
/* */
/*                         // refresh the sortable option when a new element is added*/
/*                         jQuery('#sonata-ba-field-container-{{ id }}').bind('sonata.add_element', function() {*/
/*                             apply_position_value_{{ id }}();*/
/*                             jQuery('div#field_container_{{ id }} tbody.sonata-ba-tbody').sortable('refresh');*/
/*                         });*/
/* */
/*                         apply_position_value_{{ id }}();*/
/*                     {% else %}*/
/*                         jQuery('div#field_container_{{ id }} .sonata-ba-tabs').sortable({*/
/*                             axis: 'y',*/
/*                             opacity: 0.6,*/
/*                             items: '> div',*/
/*                             stop: apply_position_value_{{ id }}*/
/*                         });*/
/* */
/*                         function apply_position_value_{{ id }}() {*/
/*                             // update the input value position*/
/*                             jQuery('div#field_container_{{ id }} .sonata-ba-tabs .sonata-ba-field-{{ id }}-{{ sonata_admin.field_description.options.sortable }}').each(function(index, element) {*/
/*                                 // remove the sortable handler and put it back*/
/*                                 var parent = jQuery(element).closest('.nav-tabs-custom');*/
/*                                 var tabs = parent.find('> .nav-tabs');*/
/*                                 jQuery('.sonata-ba-sortable-handler', tabs).remove();*/
/*                                 $('<li class="sonata-ba-sortable-handler pull-right"></li>')*/
/*                                         .prepend('<span class="ui-icon ui-icon-grip-solid-horizontal"></span>')*/
/*                                         .appendTo(tabs);*/
/*                                 jQuery('input', element).hide();*/
/*                             });*/
/* */
/*                             jQuery('div#field_container_{{ id }} .sonata-ba-tabs .sonata-ba-field-{{ id }}-{{ sonata_admin.field_description.options.sortable }} input').each(function(index, value) {*/
/*                                 jQuery(value).val(index + 1);*/
/*                             });*/
/*                         }*/
/* */
/*                         // refresh the sortable option when a new element is added*/
/*                         jQuery('#sonata-ba-field-container-{{ id }}').bind('sonata.add_element', function() {*/
/*                             apply_position_value_{{ id }}();*/
/*                             jQuery('div#field_container_{{ id }} .sonata-ba-tabs').sortable('refresh');*/
/*                         });*/
/* */
/*                         apply_position_value_{{ id }}();*/
/*                     {% endif %}*/
/*                 </script>*/
/*             {% endif %}*/
/* */
/*             {# include association code #}*/
/*             {% include 'SonataDoctrineORMAdminBundle:CRUD:edit_orm_one_association_script.html.twig' %}*/
/* */
/*         {% else %}*/
/*             <span id="field_actions_{{ id }}" >*/
/*                 {% if sonata_admin.field_description.associationadmin.hasroute('create') and sonata_admin.field_description.associationadmin.isGranted('CREATE') and btn_add and ( sonata_admin.field_description.options.limit is not defined or form.children|length < sonata_admin.field_description.options.limit ) %}*/
/*                     <a*/
/*                         href="{{ sonata_admin.field_description.associationadmin.generateUrl('create', sonata_admin.field_description.getOption('link_parameters', {})) }}"*/
/*                         onclick="return start_field_dialog_form_add_{{ id }}(this);"*/
/*                         class="btn btn-success btn-sm sonata-ba-action"*/
/*                         title="{{ btn_add|trans({}, btn_catalogue) }}"*/
/*                         >*/
/*                         <i class="fa fa-plus-circle"></i>*/
/*                         {{ btn_add|trans({}, btn_catalogue) }}*/
/*                     </a>*/
/*                 {% endif %}*/
/*             </span>*/
/* */
/*             {% include 'SonataDoctrineORMAdminBundle:CRUD:edit_modal.html.twig' %}*/
/* */
/*             {% include 'SonataDoctrineORMAdminBundle:CRUD:edit_orm_many_association_script.html.twig' %}*/
/*         {% endif %}*/
/*     </div>*/
/* {% endif %}*/
/* */
