<?php

/* SonataBlockBundle:Profiler:block.html.twig */
class __TwigTemplate_cba5806f746d0e78497d70eb72b1395f5db53a808f43461a52e81eab5679d1d4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig", "SonataBlockBundle:Profiler:block.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
            'table' => array($this, 'block_table'),
            'table_v2' => array($this, 'block_table_v2'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $context["profiler_markup_version"] = ((array_key_exists("profiler_markup_version", $context)) ? (_twig_default_filter((isset($context["profiler_markup_version"]) ? $context["profiler_markup_version"] : null), 1)) : (1));
        // line 5
        echo "
    <div class=\"sf-toolbar-block\">
        ";
        // line 7
        if (((isset($context["profiler_markup_version"]) ? $context["profiler_markup_version"] : null) == 1)) {
            // line 8
            echo "            <div class=\"sf-toolbar-icon\">
                <a href=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("token" => (isset($context["token"]) ? $context["token"] : null), "panel" => (isset($context["name"]) ? $context["name"] : null))), "html", null, true);
            echo "\">
                    ";
            // line 10
            echo "<span style=\"width:0px; height: 28px; vertical-align: middle;\"></span>
                    <span class=\"sf-toolbar-status\">";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "getTotalBlock", array(), "method"), "html", null, true);
            echo "</span> blocks
                </a>
            </div>
        ";
        } else {
            // line 15
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("token" => (isset($context["token"]) ? $context["token"] : null), "panel" => (isset($context["name"]) ? $context["name"] : null))), "html", null, true);
            echo "\">
                <div class=\"sf-toolbar-icon\">
                    ";
            // line 17
            echo twig_include($this->env, $context, "@SonataBlock/Profiler/icon.svg");
            echo "
                    <span class=\"sf-toolbar-value\">";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "getTotalBlock", array(), "method"), "html", null, true);
            echo "</span>
                </div>
            </a>
        ";
        }
        // line 22
        echo "
        <div class=\"sf-toolbar-info\">
            <div class=\"sf-toolbar-info-piece\">
                <b>Real Blocks</b>
                <span>";
        // line 26
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "realBlocks", array())), "html", null, true);
        echo "</span>
            </div>
            <div class=\"sf-toolbar-info-piece\">
                <b>Containers</b>
                <span>";
        // line 30
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "containers", array())), "html", null, true);
        echo "</span>
            </div>
            ";
        // line 32
        if (((isset($context["profiler_markup_version"]) ? $context["profiler_markup_version"] : null) == 1)) {
            // line 33
            echo "                ";
            // line 35
            echo "                <div class=\"sf-toolbar-info-piece\">
                    <b>Total Blocks</b>
                    <span>";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "getTotalBlock", array(), "method"), "html", null, true);
            echo "</span>
                </div>
            ";
        }
        // line 40
        echo "            <div class=\"sf-toolbar-info-piece\">
                ";
        // line 41
        if (((isset($context["profiler_markup_version"]) ? $context["profiler_markup_version"] : null) == 1)) {
            echo "<hr />";
        }
        // line 42
        echo "                <b>Events</b>
                <span>";
        // line 43
        echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "events", array())), "html", null, true);
        echo "</span>
            </div>
        </div>
    </div>
";
    }

    // line 49
    public function block_menu($context, array $blocks = array())
    {
        // line 50
        echo "    <span class=\"label\">
        <span class=\"icon\">
            ";
        // line 52
        echo twig_include($this->env, $context, "@SonataBlock/Profiler/icon.svg");
        echo "
        </span>
        <strong>Blocks";
        // line 54
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "events", array())) > 0)) {
            echo "<strong>*</strong>";
        }
        echo "</strong>
        <span class=\"count\">
            <span>";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "getTotalBlock", array(), "method"), "html", null, true);
        echo "</span>
        </span>
    </span>
";
    }

    // line 61
    public function block_panel($context, array $blocks = array())
    {
        // line 62
        echo "    ";
        // line 63
        echo "    ";
        $context["profiler_markup_version"] = ((array_key_exists("profiler_markup_version", $context)) ? (_twig_default_filter((isset($context["profiler_markup_version"]) ? $context["profiler_markup_version"] : null), 1)) : (1));
        // line 64
        echo "
    <h2>Events Blocks</h2>
    <table>
        <tr>
            <th>code name</th>
            <th>listener tag</th>
            <th>Block types</th>
            <th>Listeners</th>
        </tr>

        ";
        // line 74
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "events", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 75
            echo "            <tr>
                <td>";
            // line 76
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "template_code", array(), "array"), "html", null, true);
            echo "</td>
                <td>";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute($context["event"], "event_name", array(), "array"), "html", null, true);
            echo "</td>
                <td>
                    ";
            // line 79
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["event"], "blocks", array(), "array"));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["type"]) {
                // line 80
                echo "                        ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["type"], 1, array()), "html", null, true);
                echo " (id:";
                echo twig_escape_filter($this->env, $this->getAttribute($context["type"], 0, array()), "html", null, true);
                echo ")
                    ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 82
                echo "                        no block returned
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['type'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 84
            echo "                </td>
                <td>
                    ";
            // line 86
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["event"], "listeners", array(), "array"));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["listener"]) {
                // line 87
                echo "                        ";
                echo twig_escape_filter($this->env, $context["listener"], "html", null, true);
                echo "
                    ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 89
                echo "                        no listener registered
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['listener'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 91
            echo "                </td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        echo "    </table>

    <h2>Real Blocks</h2>
    ";
        // line 97
        $context["blocks"] = $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "realBlocks", array());
        // line 98
        echo "    ";
        if (((isset($context["profiler_markup_version"]) ? $context["profiler_markup_version"] : null) == 1)) {
            // line 99
            echo "        ";
            $this->displayBlock("table", $context, $blocks);
            echo "
    ";
        } else {
            // line 101
            echo "        <div class=\"tab-content\">
            ";
            // line 102
            $this->displayBlock("table_v2", $context, $blocks);
            echo "
        </div>
    ";
        }
        // line 105
        echo "
    <h2>Containers Blocks</h2>
    ";
        // line 107
        $context["blocks"] = $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "containers", array());
        // line 108
        echo "    ";
        if (((isset($context["profiler_markup_version"]) ? $context["profiler_markup_version"] : null) == 1)) {
            // line 109
            echo "        ";
            $this->displayBlock("table", $context, $blocks);
            echo "
    ";
        } else {
            // line 111
            echo "        <div class=\"tab-content\">
            ";
            // line 112
            $this->displayBlock("table_v2", $context, $blocks);
            echo "
        </div>
    ";
        }
        // line 115
        echo "
    ";
        // line 116
        $this->displayBlock("javascript", $context, $blocks);
        echo "
";
    }

    // line 119
    public function block_table($context, array $blocks = array())
    {
        // line 120
        echo "    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Mem. (diff)</th>
            <th>Mem. (peak)</th>
            <th>Duration</th>
        </tr>
        ";
        // line 129
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["blocks"]) ? $context["blocks"] : null));
        foreach ($context['_seq'] as $context["id"] => $context["block"]) {
            // line 130
            echo "
            ";
            // line 131
            $context["rowspan"] = 1;
            // line 132
            echo "            ";
            if ($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "handler", array())) {
                // line 133
                echo "                ";
                $context["rowspan"] = ((isset($context["rowspan"]) ? $context["rowspan"] : null) + 1);
                // line 134
                echo "            ";
            }
            // line 135
            echo "
            ";
            // line 136
            if (((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "assets", array()), "js", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "assets", array()), "css", array())) > 0))) {
                // line 137
                echo "                ";
                $context["rowspan"] = ((isset($context["rowspan"]) ? $context["rowspan"] : null) + 1);
                // line 138
                echo "            ";
            }
            // line 139
            echo "            <tr>
                <th style=\"vertical-align: top\" rowspan=\"";
            // line 140
            echo twig_escape_filter($this->env, (isset($context["rowspan"]) ? $context["rowspan"] : null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "</th>
                <td>";
            // line 141
            echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "name", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 142
            echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "type", array()), "html", null, true);
            echo "</td>
                <td>";
            // line 143
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (($this->getAttribute($context["block"], "memory_end", array()) - $this->getAttribute($context["block"], "memory_start", array())) / 1000), 0), "html", null, true);
            echo " Kb</td>
                <td>";
            // line 144
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($this->getAttribute($context["block"], "memory_peak", array()) / 1000), 0), "html", null, true);
            echo " Kb</td>
                <td>";
            // line 145
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["block"], "duration", array()), 2), "html", null, true);
            echo " ms</td>
            </tr>

            ";
            // line 148
            if ($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "handler", array())) {
                // line 149
                echo "                <tr style=\"vertical-align: top\">
                    <td colspan=\"3\">
                        Cache Keys: <pre>";
                // line 151
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "keys", array())), "html", null, true);
                echo "</pre> <br />
                        Contextual Keys: <pre>";
                // line 152
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "contextual_keys", array())), "html", null, true);
                echo "</pre>
                    </td>
                    <td colspan=\"2\">
                        TTL: ";
                // line 155
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "cache", array()), "ttl", array()), "html", null, true);
                echo "s. <br />
                        Lifetime: ";
                // line 156
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "cache", array()), "lifetime", array()), "html", null, true);
                echo "s. <br />
                        Backend: ";
                // line 157
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "cache", array()), "handler", array()), "html", null, true);
                echo " <br />
                        Loading from cache: ";
                // line 158
                if ($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "from_cache", array())) {
                    echo "YES";
                } else {
                    echo "NO";
                }
                echo " <br />
                    </td>
                </tr>
            ";
            }
            // line 162
            echo "
            ";
            // line 163
            if (((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "assets", array()), "js", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "assets", array()), "css", array())) > 0))) {
                // line 164
                echo "                <tr>
                    <td colspan=\"5\">
                        Javascripts: <pre>";
                // line 166
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getAttribute($context["block"], "assets", array()), "js", array())), "html", null, true);
                echo "</pre><br />
                        Stylesheets: <pre>";
                // line 167
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getAttribute($context["block"], "assets", array()), "css", array())), "html", null, true);
                echo "</pre>
                    </td>
                </tr>
            ";
            }
            // line 171
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 173
        echo "    </table>
";
    }

    // line 176
    public function block_table_v2($context, array $blocks = array())
    {
        // line 177
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["blocks"]) ? $context["blocks"] : null));
        foreach ($context['_seq'] as $context["id"] => $context["block"]) {
            // line 178
            echo "        <table>
            <thead>
            <tr>
                <th colspan=\"2\">Block ";
            // line 181
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>Name</th>
                <td>";
            // line 187
            echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "name", array()), "html", null, true);
            echo "</td>
            </tr>
            <tr>
                <th>Type</th>
                <td>";
            // line 191
            echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "type", array()), "html", null, true);
            echo "</td>
            </tr>
            <tr>
                <th>Mem. diff / Mem. peak / Duration</th>
                <td>";
            // line 195
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (($this->getAttribute($context["block"], "memory_end", array()) - $this->getAttribute($context["block"], "memory_start", array())) / 1000), 0), "html", null, true);
            echo " Kb / ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($this->getAttribute($context["block"], "memory_peak", array()) / 1000), 0), "html", null, true);
            echo " Kb / ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["block"], "duration", array()), 2), "html", null, true);
            echo " ms</td>
            </tr>

            ";
            // line 198
            if ($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "handler", array())) {
                // line 199
                echo "                <tr>
                    <th>Cache backend</th>
                    <td>
                        ";
                // line 202
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "cache", array()), "handler", array()), "html", null, true);
                echo " - Loading from cache: ";
                if ($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "from_cache", array())) {
                    echo "YES";
                } else {
                    echo "NO";
                }
                // line 203
                echo "                    </td>
                </tr>
                <tr>
                    <th>Cache TTL / Lifetime</th>
                    <td>
                        ";
                // line 208
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "cache", array()), "ttl", array()), "html", null, true);
                echo "s. / ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "cache", array()), "lifetime", array()), "html", null, true);
                echo "s
                    </td>
                </tr>
                <tr>
                    <th>
                        Cache Informations
                    </th>
                    <td>
                        Cache Keys: <pre>";
                // line 216
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "keys", array())), "html", null, true);
                echo "</pre> <br />
                        Contextual Keys: <pre>";
                // line 217
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getAttribute($context["block"], "cache", array()), "contextual_keys", array())), "html", null, true);
                echo "</pre> <br />
                    </td>
                </tr>
            ";
            }
            // line 221
            echo "
            ";
            // line 222
            if (((twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "assets", array()), "js", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["block"], "assets", array()), "css", array())) > 0))) {
                // line 223
                echo "                <tr>
                    <th>Assets</th>
                    <td>
                        Javascripts: <pre>";
                // line 226
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getAttribute($context["block"], "assets", array()), "js", array())), "html", null, true);
                echo "</pre><br />
                        Stylesheets: <pre>";
                // line 227
                echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getAttribute($context["block"], "assets", array()), "css", array())), "html", null, true);
                echo "</pre>
                    </td>
                </tr>
            ";
            }
            // line 231
            echo "            </tbody>
        </table>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['id'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "SonataBlockBundle:Profiler:block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  562 => 231,  555 => 227,  551 => 226,  546 => 223,  544 => 222,  541 => 221,  534 => 217,  530 => 216,  517 => 208,  510 => 203,  502 => 202,  497 => 199,  495 => 198,  485 => 195,  478 => 191,  471 => 187,  462 => 181,  457 => 178,  452 => 177,  449 => 176,  444 => 173,  437 => 171,  430 => 167,  426 => 166,  422 => 164,  420 => 163,  417 => 162,  406 => 158,  402 => 157,  398 => 156,  394 => 155,  388 => 152,  384 => 151,  380 => 149,  378 => 148,  372 => 145,  368 => 144,  364 => 143,  360 => 142,  356 => 141,  350 => 140,  347 => 139,  344 => 138,  341 => 137,  339 => 136,  336 => 135,  333 => 134,  330 => 133,  327 => 132,  325 => 131,  322 => 130,  318 => 129,  307 => 120,  304 => 119,  298 => 116,  295 => 115,  289 => 112,  286 => 111,  280 => 109,  277 => 108,  275 => 107,  271 => 105,  265 => 102,  262 => 101,  256 => 99,  253 => 98,  251 => 97,  246 => 94,  238 => 91,  231 => 89,  223 => 87,  218 => 86,  214 => 84,  207 => 82,  197 => 80,  192 => 79,  187 => 77,  183 => 76,  180 => 75,  176 => 74,  164 => 64,  161 => 63,  159 => 62,  156 => 61,  148 => 56,  141 => 54,  136 => 52,  132 => 50,  129 => 49,  120 => 43,  117 => 42,  113 => 41,  110 => 40,  104 => 37,  100 => 35,  98 => 33,  96 => 32,  91 => 30,  84 => 26,  78 => 22,  71 => 18,  67 => 17,  61 => 15,  54 => 11,  51 => 10,  47 => 9,  44 => 8,  42 => 7,  38 => 5,  35 => 4,  32 => 3,  11 => 1,);
    }
}
/* {% extends 'WebProfilerBundle:Profiler:layout.html.twig' %}*/
/* */
/* {% block toolbar %}*/
/*     {% set profiler_markup_version = profiler_markup_version|default(1) %}*/
/* */
/*     <div class="sf-toolbar-block">*/
/*         {% if profiler_markup_version == 1 %}*/
/*             <div class="sf-toolbar-icon">*/
/*                 <a href="{{ path('_profiler', { 'token': token, 'panel': name }) }}">*/
/*                     {# fake image span #}<span style="width:0px; height: 28px; vertical-align: middle;"></span>*/
/*                     <span class="sf-toolbar-status">{{ collector.getTotalBlock() }}</span> blocks*/
/*                 </a>*/
/*             </div>*/
/*         {% else %}*/
/*             <a href="{{ path('_profiler', { 'token': token, 'panel': name }) }}">*/
/*                 <div class="sf-toolbar-icon">*/
/*                     {{ include('@SonataBlock/Profiler/icon.svg') }}*/
/*                     <span class="sf-toolbar-value">{{ collector.getTotalBlock() }}</span>*/
/*                 </div>*/
/*             </a>*/
/*         {% endif %}*/
/* */
/*         <div class="sf-toolbar-info">*/
/*             <div class="sf-toolbar-info-piece">*/
/*                 <b>Real Blocks</b>*/
/*                 <span>{{ collector.realBlocks|length }}</span>*/
/*             </div>*/
/*             <div class="sf-toolbar-info-piece">*/
/*                 <b>Containers</b>*/
/*                 <span>{{ collector.containers|length }}</span>*/
/*             </div>*/
/*             {% if profiler_markup_version == 1 %}*/
/*                 {# don't show the total number of blocks in the info in the new design,*/
/*                 it's already shown in the toolbar #}*/
/*                 <div class="sf-toolbar-info-piece">*/
/*                     <b>Total Blocks</b>*/
/*                     <span>{{ collector.getTotalBlock() }}</span>*/
/*                 </div>*/
/*             {% endif %}*/
/*             <div class="sf-toolbar-info-piece">*/
/*                 {% if profiler_markup_version == 1 %}<hr />{% endif %}*/
/*                 <b>Events</b>*/
/*                 <span>{{ collector.events|length }}</span>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block menu %}*/
/*     <span class="label">*/
/*         <span class="icon">*/
/*             {{ include('@SonataBlock/Profiler/icon.svg') }}*/
/*         </span>*/
/*         <strong>Blocks{% if collector.events|length > 0 %}<strong>*</strong>{% endif %}</strong>*/
/*         <span class="count">*/
/*             <span>{{ collector.getTotalBlock() }}</span>*/
/*         </span>*/
/*     </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {# NEXT_MAJOR : remove this when Symfony Requirement will be bumped to 2.8+ #}*/
/*     {% set profiler_markup_version = profiler_markup_version|default(1) %}*/
/* */
/*     <h2>Events Blocks</h2>*/
/*     <table>*/
/*         <tr>*/
/*             <th>code name</th>*/
/*             <th>listener tag</th>*/
/*             <th>Block types</th>*/
/*             <th>Listeners</th>*/
/*         </tr>*/
/* */
/*         {% for event in collector.events %}*/
/*             <tr>*/
/*                 <td>{{ event['template_code'] }}</td>*/
/*                 <td>{{ event['event_name'] }}</td>*/
/*                 <td>*/
/*                     {% for type in event['blocks'] %}*/
/*                         {{ type.1 }} (id:{{ type.0 }})*/
/*                     {% else %}*/
/*                         no block returned*/
/*                     {% endfor %}*/
/*                 </td>*/
/*                 <td>*/
/*                     {% for listener in event['listeners'] %}*/
/*                         {{ listener }}*/
/*                     {% else %}*/
/*                         no listener registered*/
/*                     {% endfor %}*/
/*                 </td>*/
/*             </tr>*/
/*         {% endfor %}*/
/*     </table>*/
/* */
/*     <h2>Real Blocks</h2>*/
/*     {% set blocks = collector.realBlocks %}*/
/*     {% if profiler_markup_version == 1 %}*/
/*         {{ block('table') }}*/
/*     {% else %}*/
/*         <div class="tab-content">*/
/*             {{ block('table_v2') }}*/
/*         </div>*/
/*     {% endif %}*/
/* */
/*     <h2>Containers Blocks</h2>*/
/*     {% set blocks = collector.containers %}*/
/*     {% if profiler_markup_version == 1 %}*/
/*         {{ block('table') }}*/
/*     {% else %}*/
/*         <div class="tab-content">*/
/*             {{ block('table_v2') }}*/
/*         </div>*/
/*     {% endif %}*/
/* */
/*     {{ block('javascript') }}*/
/* {% endblock %}*/
/* */
/* {% block table %}*/
/*     <table>*/
/*         <tr>*/
/*             <th>Id</th>*/
/*             <th>Name</th>*/
/*             <th>Type</th>*/
/*             <th>Mem. (diff)</th>*/
/*             <th>Mem. (peak)</th>*/
/*             <th>Duration</th>*/
/*         </tr>*/
/*         {% for id, block in blocks %}*/
/* */
/*             {% set rowspan = 1 %}*/
/*             {% if block.cache.handler %}*/
/*                 {% set rowspan = rowspan + 1 %}*/
/*             {% endif %}*/
/* */
/*             {% if block.assets.js|length > 0 or block.assets.css|length > 0 %}*/
/*                 {% set rowspan = rowspan + 1 %}*/
/*             {% endif %}*/
/*             <tr>*/
/*                 <th style="vertical-align: top" rowspan="{{ rowspan }}">{{ id }}</th>*/
/*                 <td>{{ block.name }}</td>*/
/*                 <td>{{ block.type }}</td>*/
/*                 <td>{{ ((block.memory_end-block.memory_start)/1000)|number_format(0) }} Kb</td>*/
/*                 <td>{{ (block.memory_peak/1000)|number_format(0) }} Kb</td>*/
/*                 <td>{{ block.duration|number_format(2) }} ms</td>*/
/*             </tr>*/
/* */
/*             {% if block.cache.handler %}*/
/*                 <tr style="vertical-align: top">*/
/*                     <td colspan="3">*/
/*                         Cache Keys: <pre>{{ block.cache.keys|json_encode() }}</pre> <br />*/
/*                         Contextual Keys: <pre>{{ block.cache.contextual_keys|json_encode() }}</pre>*/
/*                     </td>*/
/*                     <td colspan="2">*/
/*                         TTL: {{ block.cache.ttl }}s. <br />*/
/*                         Lifetime: {{ block.cache.lifetime }}s. <br />*/
/*                         Backend: {{ block.cache.handler }} <br />*/
/*                         Loading from cache: {% if block.cache.from_cache %}YES{% else %}NO{% endif %} <br />*/
/*                     </td>*/
/*                 </tr>*/
/*             {% endif %}*/
/* */
/*             {% if block.assets.js|length > 0 or block.assets.css|length > 0  %}*/
/*                 <tr>*/
/*                     <td colspan="5">*/
/*                         Javascripts: <pre>{{ block.assets.js|json_encode() }}</pre><br />*/
/*                         Stylesheets: <pre>{{ block.assets.css|json_encode() }}</pre>*/
/*                     </td>*/
/*                 </tr>*/
/*             {% endif %}*/
/* */
/*         {% endfor %}*/
/*     </table>*/
/* {% endblock %}*/
/* */
/* {% block table_v2 %}*/
/*     {% for id, block in blocks %}*/
/*         <table>*/
/*             <thead>*/
/*             <tr>*/
/*                 <th colspan="2">Block {{ id }}</th>*/
/*             </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*             <tr>*/
/*                 <th>Name</th>*/
/*                 <td>{{ block.name }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Type</th>*/
/*                 <td>{{ block.type }}</td>*/
/*             </tr>*/
/*             <tr>*/
/*                 <th>Mem. diff / Mem. peak / Duration</th>*/
/*                 <td>{{ ((block.memory_end-block.memory_start)/1000)|number_format(0) }} Kb / {{ (block.memory_peak/1000)|number_format(0) }} Kb / {{ block.duration|number_format(2) }} ms</td>*/
/*             </tr>*/
/* */
/*             {% if block.cache.handler %}*/
/*                 <tr>*/
/*                     <th>Cache backend</th>*/
/*                     <td>*/
/*                         {{ block.cache.handler }} - Loading from cache: {% if block.cache.from_cache %}YES{% else %}NO{% endif %}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <th>Cache TTL / Lifetime</th>*/
/*                     <td>*/
/*                         {{ block.cache.ttl }}s. / {{ block.cache.lifetime }}s*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <th>*/
/*                         Cache Informations*/
/*                     </th>*/
/*                     <td>*/
/*                         Cache Keys: <pre>{{ block.cache.keys|json_encode() }}</pre> <br />*/
/*                         Contextual Keys: <pre>{{ block.cache.contextual_keys|json_encode() }}</pre> <br />*/
/*                     </td>*/
/*                 </tr>*/
/*             {% endif %}*/
/* */
/*             {% if block.assets.js|length > 0 or block.assets.css|length > 0  %}*/
/*                 <tr>*/
/*                     <th>Assets</th>*/
/*                     <td>*/
/*                         Javascripts: <pre>{{ block.assets.js|json_encode() }}</pre><br />*/
/*                         Stylesheets: <pre>{{ block.assets.css|json_encode() }}</pre>*/
/*                     </td>*/
/*                 </tr>*/
/*             {% endif %}*/
/*             </tbody>*/
/*         </table>*/
/*     {% endfor %}*/
/* {% endblock %}*/
/* */
