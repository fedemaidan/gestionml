<?php

/* SonataAdminBundle:Form/Type:sonata_type_model_autocomplete.html.twig */
class __TwigTemplate_7ae6bb485469a145005222a8d3b27738a7b25e73f2d01b42a79d8415e84be496 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_type_model_autocomplete_ajax_request_parameters' => array($this, 'block_sonata_type_model_autocomplete_ajax_request_parameters'),
            'sonata_type_model_autocomplete_dropdown_item_format' => array($this, 'block_sonata_type_model_autocomplete_dropdown_item_format'),
            'sonata_type_model_autocomplete_selection_format' => array($this, 'block_sonata_type_model_autocomplete_selection_format'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        ob_start();
        // line 12
        echo "
    <input type=\"text\" id=\"";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_autocomplete_input\" value=\"\"";
        // line 14
        if ((isset($context["read_only"]) ? $context["read_only"] : null)) {
            echo " readonly=\"readonly\"";
        }
        // line 15
        if ((isset($context["disabled"]) ? $context["disabled"] : null)) {
            echo " disabled=\"disabled\"";
        }
        // line 16
        if ((isset($context["required"]) ? $context["required"] : null)) {
            echo " required=\"required\"";
        }
        // line 17
        echo "    />

    <div id=\"";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_hidden_inputs_wrap\">
        ";
        // line 20
        if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
            // line 21
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
            foreach ($context['_seq'] as $context["idx"] => $context["val"]) {
                if ((($context["idx"] . "") != "_labels")) {
                    // line 22
                    echo "<input type=\"hidden\" name=\"";
                    echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : null), "html", null, true);
                    echo "[]\"";
                    if ((isset($context["disabled"]) ? $context["disabled"] : null)) {
                        echo " disabled=\"disabled\"";
                    }
                    echo " value=\"";
                    echo twig_escape_filter($this->env, $context["val"], "html", null, true);
                    echo "\">";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['idx'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 25
            echo "<input type=\"hidden\" name=\"";
            echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : null), "html", null, true);
            echo "\"";
            if ((isset($context["disabled"]) ? $context["disabled"] : null)) {
                echo " disabled=\"disabled\"";
            }
            echo " value=\"";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["value"]) ? $context["value"] : null), 0, array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["value"]) ? $context["value"] : null), 0, array(), "array"), "")) : ("")), "html", null, true);
            echo "\">
        ";
        }
        // line 27
        echo "</div>

    <script>
        (function (\$) {
            var autocompleteInput = \$('#";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_autocomplete_input');
            autocompleteInput.select2({";
        // line 33
        $context["allowClearPlaceholder"] = ((( !(isset($context["multiple"]) ? $context["multiple"] : null) &&  !(isset($context["required"]) ? $context["required"] : null))) ? (" ") : (""));
        // line 34
        echo "placeholder: '";
        echo twig_escape_filter($this->env, (((isset($context["placeholder"]) ? $context["placeholder"] : null)) ? ((isset($context["placeholder"]) ? $context["placeholder"] : null)) : ((isset($context["allowClearPlaceholder"]) ? $context["allowClearPlaceholder"] : null))), "html", null, true);
        echo "', // allowClear needs placeholder to work properly
                allowClear: ";
        // line 35
        echo (((isset($context["required"]) ? $context["required"] : null)) ? ("false") : ("true"));
        echo ",
                enable: ";
        // line 36
        echo (((isset($context["disabled"]) ? $context["disabled"] : null)) ? ("false") : ("true"));
        echo ",
                readonly: ";
        // line 37
        echo (((isset($context["read_only"]) ? $context["read_only"] : null)) ? ("true") : ("false"));
        echo ",
                minimumInputLength: ";
        // line 38
        echo twig_escape_filter($this->env, (isset($context["minimum_input_length"]) ? $context["minimum_input_length"] : null), "html", null, true);
        echo ",
                multiple: ";
        // line 39
        echo (((isset($context["multiple"]) ? $context["multiple"] : null)) ? ("true") : ("false"));
        echo ",
                width: '";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["width"]) ? $context["width"] : null), "html", null, true);
        echo "',
                dropdownAutoWidth: ";
        // line 41
        echo (((isset($context["dropdown_auto_width"]) ? $context["dropdown_auto_width"] : null)) ? ("true") : ("false"));
        echo ",
                containerCssClass: '";
        // line 42
        echo twig_escape_filter($this->env, ((isset($context["container_css_class"]) ? $context["container_css_class"] : null) . " form-control"), "html", null, true);
        echo "',
                dropdownCssClass: '";
        // line 43
        echo twig_escape_filter($this->env, (isset($context["dropdown_css_class"]) ? $context["dropdown_css_class"] : null), "html", null, true);
        echo "',
                ajax: {
                    url:  '";
        // line 45
        echo twig_escape_filter($this->env, (((isset($context["url"]) ? $context["url"] : null)) ? ((isset($context["url"]) ? $context["url"] : null)) : (twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath($this->getAttribute((isset($context["route"]) ? $context["route"] : null), "name", array()), (($this->getAttribute((isset($context["route"]) ? $context["route"] : null), "parameters", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["route"]) ? $context["route"] : null), "parameters", array()), array())) : (array()))), "js"))), "html", null, true);
        echo "',
                    dataType: 'json',
                    quietMillis: ";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["quiet_millis"]) ? $context["quiet_millis"] : null), "html", null, true);
        echo ",
                    cache: ";
        // line 48
        echo (((isset($context["cache"]) ? $context["cache"] : null)) ? ("true") : ("false"));
        echo ",
                    data: function (term, page) { // page is the one-based page number tracked by Select2
                        ";
        // line 50
        $this->displayBlock('sonata_type_model_autocomplete_ajax_request_parameters', $context, $blocks);
        // line 90
        echo "                    },
                    results: function (data, page) {
                        // notice we return the value of more so Select2 knows if more results can be loaded
                        return {results: data.items, more: data.more};
                    }
                },
                formatResult: function (item) {
                    return ";
        // line 97
        $this->displayBlock('sonata_type_model_autocomplete_dropdown_item_format', $context, $blocks);
        echo ";// format of one dropdown item
                },
                formatSelection: function (item) {
                    return ";
        // line 100
        $this->displayBlock('sonata_type_model_autocomplete_selection_format', $context, $blocks);
        echo ";// format selected item '<b>'+item.label+'</b>';
                },
                escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
            });

            autocompleteInput.on('change', function(e) {

                // console.log('change '+JSON.stringify({val:e.val, added:e.added, removed:e.removed}));

                // remove input
                if (undefined !== e.removed && null !== e.removed) {
                    var removedItems = e.removed;

                    ";
        // line 113
        if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
            // line 114
            echo "                        if(!\$.isArray(removedItems)) {
                            removedItems = [removedItems];
                        }

                        var length = removedItems.length;
                        for (var i = 0; i < length; i++) {
                            el = removedItems[i];
                            \$('#";
            // line 121
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "_hidden_inputs_wrap input:hidden[value=\"'+el.id+'\"]').remove();
                        }";
        } else {
            // line 124
            echo "\$('#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "_hidden_inputs_wrap input:hidden').val('');";
        }
        // line 126
        echo "                }

                // add new input
                var el = null;
                if (undefined !== e.added) {

                    var addedItems = e.added;

                    ";
        // line 134
        if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
            // line 135
            echo "                        if(!\$.isArray(addedItems)) {
                            addedItems = [addedItems];
                        }

                        var length = addedItems.length;
                        for (var i = 0; i < length; i++) {
                            el = addedItems[i];
                            \$('#";
            // line 142
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "_hidden_inputs_wrap').append('<input type=\"hidden\" name=\"";
            echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : null), "html", null, true);
            echo "[]\" value=\"'+el.id+'\" />');
                        }";
        } else {
            // line 145
            echo "\$('#";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
            echo "_hidden_inputs_wrap input:hidden').val(addedItems.id);";
        }
        // line 147
        echo "                }
            });

            // Initialise the autocomplete
            var data = [];";
        // line 153
        if ( !twig_test_empty((isset($context["value"]) ? $context["value"] : null))) {
            // line 154
            echo "data =";
            if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
                echo "[";
            }
            // line 155
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["idx"] => $context["val"]) {
                if ((($context["idx"] . "") != "_labels")) {
                    // line 156
                    if ( !$this->getAttribute($context["loop"], "first", array())) {
                        echo ", ";
                    }
                    // line 157
                    echo "{id: '";
                    echo twig_escape_filter($this->env, twig_escape_filter($this->env, $context["val"], "js"), "html", null, true);
                    echo "', label:'";
                    echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "_labels", array(), "array"), $context["idx"], array(), "array"), "js"), "html", null, true);
                    echo "'}";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['idx'], $context['val'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 159
            if ((isset($context["multiple"]) ? $context["multiple"] : null)) {
                echo "]";
            }
            echo ";
            ";
        }
        // line 162
        echo "if (undefined==data.length || 0<data.length) { // Leave placeholder if no data set
                autocompleteInput.select2('data', data);
            }

            // remove unneeded autocomplete text input before form submit
            \$('#";
        // line 167
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_autocomplete_input').closest('form').submit(function()
            {
                \$('#";
        // line 169
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : null), "html", null, true);
        echo "_autocomplete_input').remove();
                return true;
            });
        })(jQuery);
    </script>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 50
    public function block_sonata_type_model_autocomplete_ajax_request_parameters($context, array $blocks = array())
    {
        // line 51
        echo "                        return {
                                //search term
                                '";
        // line 53
        echo twig_escape_filter($this->env, (isset($context["req_param_name_search"]) ? $context["req_param_name_search"] : null), "html", null, true);
        echo "': term,

                                // page size
                                '";
        // line 56
        echo twig_escape_filter($this->env, (isset($context["req_param_name_items_per_page"]) ? $context["req_param_name_items_per_page"] : null), "html", null, true);
        echo "': ";
        echo twig_escape_filter($this->env, (isset($context["items_per_page"]) ? $context["items_per_page"] : null), "html", null, true);
        echo ",

                                // page number
                                '";
        // line 59
        echo twig_escape_filter($this->env, (isset($context["req_param_name_page_number"]) ? $context["req_param_name_page_number"] : null), "html", null, true);
        echo "': page,

                                // admin
                                ";
        // line 62
        if ( !(null === $this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()))) {
            // line 63
            echo "                                    'uniqid': '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "uniqid", array()), "html", null, true);
            echo "',
                                    'admin_code': '";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["sonata_admin"]) ? $context["sonata_admin"] : null), "admin", array()), "code", array()), "html", null, true);
            echo "',
                                ";
        } elseif (        // line 65
(isset($context["admin_code"]) ? $context["admin_code"] : null)) {
            // line 66
            echo "                                    'admin_code':  '";
            echo twig_escape_filter($this->env, (isset($context["admin_code"]) ? $context["admin_code"] : null), "html", null, true);
            echo "',
                                ";
        }
        // line 68
        echo "                                
                                 // subclass
                                ";
        // line 70
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "get", array(0 => "subclass"), "method")) {
            // line 71
            echo "                                    'subclass': '";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "query", array()), "get", array(0 => "subclass"), "method"), "html", null, true);
            echo "',
                                ";
        }
        // line 73
        echo "
                                ";
        // line 74
        if (((isset($context["context"]) ? $context["context"] : null) == "filter")) {
            // line 75
            echo "                                    'field':  '";
            echo twig_escape_filter($this->env, twig_replace_filter((isset($context["full_name"]) ? $context["full_name"] : null), array("filter[" => "", "][value]" => "", "__" => ".")), "html", null, true);
            echo "',
                                    '_context': 'filter'
                                ";
        } else {
            // line 78
            echo "                                    'field':  '";
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
            echo "'
                                ";
        }
        // line 80
        echo "
                                // other parameters
                                ";
        // line 82
        if ( !twig_test_empty((isset($context["req_params"]) ? $context["req_params"] : null))) {
            echo ",";
            // line 83
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["req_params"]) ? $context["req_params"] : null));
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
            foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                // line 84
                echo "'";
                echo twig_escape_filter($this->env, twig_escape_filter($this->env, $context["key"], "js"), "html", null, true);
                echo "': '";
                echo twig_escape_filter($this->env, twig_escape_filter($this->env, $context["value"], "js"), "html", null, true);
                echo "'";
                // line 85
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
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
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        // line 88
        echo "                        };
                        ";
    }

    // line 97
    public function block_sonata_type_model_autocomplete_dropdown_item_format($context, array $blocks = array())
    {
        echo "'<div class=\"";
        echo twig_escape_filter($this->env, (isset($context["dropdown_item_css_class"]) ? $context["dropdown_item_css_class"] : null), "html", null, true);
        echo "\">'+item.label+'<\\/div>'";
    }

    // line 100
    public function block_sonata_type_model_autocomplete_selection_format($context, array $blocks = array())
    {
        echo "item.label";
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Form/Type:sonata_type_model_autocomplete.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  448 => 100,  440 => 97,  435 => 88,  418 => 85,  412 => 84,  395 => 83,  392 => 82,  388 => 80,  382 => 78,  375 => 75,  373 => 74,  370 => 73,  364 => 71,  362 => 70,  358 => 68,  352 => 66,  350 => 65,  346 => 64,  341 => 63,  339 => 62,  333 => 59,  325 => 56,  319 => 53,  315 => 51,  312 => 50,  301 => 169,  296 => 167,  289 => 162,  282 => 159,  268 => 157,  264 => 156,  253 => 155,  248 => 154,  246 => 153,  240 => 147,  235 => 145,  228 => 142,  219 => 135,  217 => 134,  207 => 126,  202 => 124,  197 => 121,  188 => 114,  186 => 113,  170 => 100,  164 => 97,  155 => 90,  153 => 50,  148 => 48,  144 => 47,  139 => 45,  134 => 43,  130 => 42,  126 => 41,  122 => 40,  118 => 39,  114 => 38,  110 => 37,  106 => 36,  102 => 35,  97 => 34,  95 => 33,  91 => 31,  85 => 27,  73 => 25,  57 => 22,  52 => 21,  50 => 20,  46 => 19,  42 => 17,  38 => 16,  34 => 15,  30 => 14,  27 => 13,  24 => 12,  22 => 11,);
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
/* {% spaceless %}*/
/* */
/*     <input type="text" id="{{ id }}_autocomplete_input" value=""*/
/*         {%- if read_only %} readonly="readonly"{% endif -%}*/
/*         {%- if disabled %} disabled="disabled"{% endif -%}*/
/*         {%- if required %} required="required"{% endif %}*/
/*     />*/
/* */
/*     <div id="{{ id }}_hidden_inputs_wrap">*/
/*         {% if multiple -%}*/
/*             {%- for idx, val in value if idx~'' != '_labels' -%}*/
/*                 <input type="hidden" name="{{ full_name }}[]" {%- if disabled %} disabled="disabled"{% endif %} value="{{ val }}">*/
/*             {%- endfor -%}*/
/*         {% else -%}*/
/*             <input type="hidden" name="{{ full_name }}" {%- if disabled %} disabled="disabled"{% endif %} value="{{ value[0]|default('') }}">*/
/*         {% endif -%}*/
/*     </div>*/
/* */
/*     <script>*/
/*         (function ($) {*/
/*             var autocompleteInput = $('#{{ id }}_autocomplete_input');*/
/*             autocompleteInput.select2({*/
/*                 {%- set allowClearPlaceholder = (not multiple and not required) ? ' ' : '' -%}*/
/*                 placeholder: '{{ placeholder ?: allowClearPlaceholder }}', // allowClear needs placeholder to work properly*/
/*                 allowClear: {{ required ? 'false' : 'true' }},*/
/*                 enable: {{ disabled ? 'false' : 'true' }},*/
/*                 readonly: {{ read_only ? 'true' : 'false' }},*/
/*                 minimumInputLength: {{ minimum_input_length }},*/
/*                 multiple: {{ multiple ? 'true' : 'false' }},*/
/*                 width: '{{ width }}',*/
/*                 dropdownAutoWidth: {{ dropdown_auto_width ? 'true' : 'false' }},*/
/*                 containerCssClass: '{{ container_css_class ~ ' form-control' }}',*/
/*                 dropdownCssClass: '{{ dropdown_css_class }}',*/
/*                 ajax: {*/
/*                     url:  '{{ url ?: path(route.name, route.parameters|default([]))|e('js') }}',*/
/*                     dataType: 'json',*/
/*                     quietMillis: {{ quiet_millis }},*/
/*                     cache: {{ cache ? 'true' : 'false' }},*/
/*                     data: function (term, page) { // page is the one-based page number tracked by Select2*/
/*                         {% block sonata_type_model_autocomplete_ajax_request_parameters %}*/
/*                         return {*/
/*                                 //search term*/
/*                                 '{{ req_param_name_search }}': term,*/
/* */
/*                                 // page size*/
/*                                 '{{ req_param_name_items_per_page }}': {{ items_per_page }},*/
/* */
/*                                 // page number*/
/*                                 '{{ req_param_name_page_number }}': page,*/
/* */
/*                                 // admin*/
/*                                 {% if sonata_admin.admin is not null %}*/
/*                                     'uniqid': '{{ sonata_admin.admin.uniqid }}',*/
/*                                     'admin_code': '{{ sonata_admin.admin.code }}',*/
/*                                 {% elseif admin_code %}*/
/*                                     'admin_code':  '{{ admin_code }}',*/
/*                                 {% endif %}*/
/*                                 */
/*                                  // subclass*/
/*                                 {% if app.request.query.get('subclass') %}*/
/*                                     'subclass': '{{ app.request.query.get('subclass') }}',*/
/*                                 {% endif %}*/
/* */
/*                                 {% if context == 'filter' %}*/
/*                                     'field':  '{{ full_name|replace({'filter[': '', '][value]': '', '__':'.'}) }}',*/
/*                                     '_context': 'filter'*/
/*                                 {% else %}*/
/*                                     'field':  '{{ name }}'*/
/*                                 {% endif %}*/
/* */
/*                                 // other parameters*/
/*                                 {% if req_params is not empty %},*/
/*                                     {%- for key, value in req_params -%}*/
/*                                         '{{- key|e('js') -}}': '{{- value|e('js') -}}'*/
/*                                         {%- if not loop.last -%}, {% endif -%}*/
/*                                     {%- endfor -%}*/
/*                                 {% endif %}*/
/*                         };*/
/*                         {% endblock %}*/
/*                     },*/
/*                     results: function (data, page) {*/
/*                         // notice we return the value of more so Select2 knows if more results can be loaded*/
/*                         return {results: data.items, more: data.more};*/
/*                     }*/
/*                 },*/
/*                 formatResult: function (item) {*/
/*                     return {% block sonata_type_model_autocomplete_dropdown_item_format %}'<div class="{{ dropdown_item_css_class }}">'+item.label+'<\/div>'{% endblock %};// format of one dropdown item*/
/*                 },*/
/*                 formatSelection: function (item) {*/
/*                     return {% block sonata_type_model_autocomplete_selection_format %}item.label{% endblock %};// format selected item '<b>'+item.label+'</b>';*/
/*                 },*/
/*                 escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results*/
/*             });*/
/* */
/*             autocompleteInput.on('change', function(e) {*/
/* */
/*                 // console.log('change '+JSON.stringify({val:e.val, added:e.added, removed:e.removed}));*/
/* */
/*                 // remove input*/
/*                 if (undefined !== e.removed && null !== e.removed) {*/
/*                     var removedItems = e.removed;*/
/* */
/*                     {% if multiple %}*/
/*                         if(!$.isArray(removedItems)) {*/
/*                             removedItems = [removedItems];*/
/*                         }*/
/* */
/*                         var length = removedItems.length;*/
/*                         for (var i = 0; i < length; i++) {*/
/*                             el = removedItems[i];*/
/*                             $('#{{ id }}_hidden_inputs_wrap input:hidden[value="'+el.id+'"]').remove();*/
/*                         }*/
/*                     {%- else -%}*/
/*                         $('#{{ id }}_hidden_inputs_wrap input:hidden').val('');*/
/*                     {%- endif %}*/
/*                 }*/
/* */
/*                 // add new input*/
/*                 var el = null;*/
/*                 if (undefined !== e.added) {*/
/* */
/*                     var addedItems = e.added;*/
/* */
/*                     {% if multiple %}*/
/*                         if(!$.isArray(addedItems)) {*/
/*                             addedItems = [addedItems];*/
/*                         }*/
/* */
/*                         var length = addedItems.length;*/
/*                         for (var i = 0; i < length; i++) {*/
/*                             el = addedItems[i];*/
/*                             $('#{{ id }}_hidden_inputs_wrap').append('<input type="hidden" name="{{ full_name }}[]" value="'+el.id+'" />');*/
/*                         }*/
/*                     {%- else -%}*/
/*                         $('#{{ id }}_hidden_inputs_wrap input:hidden').val(addedItems.id);*/
/*                     {%- endif %}*/
/*                 }*/
/*             });*/
/* */
/*             // Initialise the autocomplete*/
/*             var data = [];*/
/* */
/*             {%- if value is not empty -%}*/
/*                 data = {%- if multiple -%}[ {%- endif -%}*/
/*                 {%- for idx, val  in value if idx~'' != '_labels' -%}*/
/*                     {%- if not loop.first -%}, {% endif -%}*/
/*                     {id: '{{ val|e('js') }}', label:'{{ value['_labels'][idx]|e('js') }}'}*/
/*                 {%- endfor -%}*/
/*                 {%- if multiple -%} ] {%- endif -%};*/
/*             {% endif -%}*/
/* */
/*             if (undefined==data.length || 0<data.length) { // Leave placeholder if no data set*/
/*                 autocompleteInput.select2('data', data);*/
/*             }*/
/* */
/*             // remove unneeded autocomplete text input before form submit*/
/*             $('#{{ id }}_autocomplete_input').closest('form').submit(function()*/
/*             {*/
/*                 $('#{{ id }}_autocomplete_input').remove();*/
/*                 return true;*/
/*             });*/
/*         })(jQuery);*/
/*     </script>*/
/* {% endspaceless %}*/
/* */
