<?php

/* SonataAdminBundle:CRUD:_email_link.html.twig */
class __TwigTemplate_3c80136e0baf1f8a9843085c0e18d1e0d6e1ba3ec44419d08ea132602dea721a extends Twig_Template
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
        // line 2
        if (twig_test_empty((isset($context["value"]) ? $context["value"] : null))) {
            // line 3
            echo "&nbsp;";
        } elseif (($this->getAttribute($this->getAttribute(        // line 4
(isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "as_string", array(), "any", true, true) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array()), "as_string", array()))) {
            // line 5
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
        } else {
            // line 7
            $context["parameters"] = array();
            // line 8
            echo "    ";
            $context["subject"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "subject", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "subject", array()), "")) : (""));
            // line 9
            echo "    ";
            $context["body"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "body", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "body", array()), "")) : (""));
            // line 10
            echo "
    ";
            // line 11
            if ( !twig_test_empty((isset($context["subject"]) ? $context["subject"] : null))) {
                // line 12
                echo "        ";
                $context["parameters"] = twig_array_merge((isset($context["parameters"]) ? $context["parameters"] : null), array("subject" => (isset($context["subject"]) ? $context["subject"] : null)));
                // line 13
                echo "    ";
            }
            // line 14
            echo "    ";
            if ( !twig_test_empty((isset($context["body"]) ? $context["body"] : null))) {
                // line 15
                echo "        ";
                $context["parameters"] = twig_array_merge((isset($context["parameters"]) ? $context["parameters"] : null), array("body" => (isset($context["body"]) ? $context["body"] : null)));
                // line 16
                echo "    ";
            }
            // line 17
            echo "
    <a href=\"mailto:";
            // line 18
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
            if ((twig_length_filter($this->env, (isset($context["parameters"]) ? $context["parameters"] : null)) > 0)) {
                echo "?";
                echo twig_escape_filter($this->env, twig_urlencode_filter((isset($context["parameters"]) ? $context["parameters"] : null)), "html", null, true);
            }
            echo "\">";
            // line 19
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : null), "html", null, true);
            // line 20
            echo "</a>";
        }
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:_email_link.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 20,  66 => 19,  59 => 18,  56 => 17,  53 => 16,  50 => 15,  47 => 14,  44 => 13,  41 => 12,  39 => 11,  36 => 10,  33 => 9,  30 => 8,  28 => 7,  25 => 5,  23 => 4,  21 => 3,  19 => 2,);
    }
}
/* */
/* {%- if value is empty -%}*/
/*     &nbsp;*/
/* {%- elseif field_description.options.as_string is defined and field_description.options.as_string -%}*/
/*     {{ value }}*/
/* {%- else -%}*/
/*     {% set parameters = {} %}*/
/*     {% set subject = field_description.options.subject|default('') %}*/
/*     {% set body = field_description.options.body|default('') %}*/
/* */
/*     {% if subject is not empty %}*/
/*         {% set parameters = parameters|merge({'subject': subject}) %}*/
/*     {% endif %}*/
/*     {% if body is not empty %}*/
/*         {% set parameters = parameters|merge({'body': body}) %}*/
/*     {% endif %}*/
/* */
/*     <a href="mailto:{{ value }}{% if parameters|length > 0 %}?{{- parameters|url_encode -}}{% endif %}">*/
/*         {{- value -}}*/
/*     </a>*/
/* {%- endif -%}*/
/* */
