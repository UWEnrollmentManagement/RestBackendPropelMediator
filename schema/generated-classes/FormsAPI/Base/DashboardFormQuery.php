<?php

namespace FormsAPI\Base;

use \Exception;
use \PDO;
use FormsAPI\DashboardForm as ChildDashboardForm;
use FormsAPI\DashboardFormQuery as ChildDashboardFormQuery;
use FormsAPI\Map\DashboardFormTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'dashboard_form' table.
 *
 *
 *
 * @method     ChildDashboardFormQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDashboardFormQuery orderByDashboardId($order = Criteria::ASC) Order by the dashboard_id column
 * @method     ChildDashboardFormQuery orderByFormId($order = Criteria::ASC) Order by the form_id column
 *
 * @method     ChildDashboardFormQuery groupById() Group by the id column
 * @method     ChildDashboardFormQuery groupByDashboardId() Group by the dashboard_id column
 * @method     ChildDashboardFormQuery groupByFormId() Group by the form_id column
 *
 * @method     ChildDashboardFormQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDashboardFormQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDashboardFormQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDashboardFormQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDashboardFormQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDashboardFormQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDashboardFormQuery leftJoinDashboard($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dashboard relation
 * @method     ChildDashboardFormQuery rightJoinDashboard($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dashboard relation
 * @method     ChildDashboardFormQuery innerJoinDashboard($relationAlias = null) Adds a INNER JOIN clause to the query using the Dashboard relation
 *
 * @method     ChildDashboardFormQuery joinWithDashboard($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Dashboard relation
 *
 * @method     ChildDashboardFormQuery leftJoinWithDashboard() Adds a LEFT JOIN clause and with to the query using the Dashboard relation
 * @method     ChildDashboardFormQuery rightJoinWithDashboard() Adds a RIGHT JOIN clause and with to the query using the Dashboard relation
 * @method     ChildDashboardFormQuery innerJoinWithDashboard() Adds a INNER JOIN clause and with to the query using the Dashboard relation
 *
 * @method     ChildDashboardFormQuery leftJoinForm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Form relation
 * @method     ChildDashboardFormQuery rightJoinForm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Form relation
 * @method     ChildDashboardFormQuery innerJoinForm($relationAlias = null) Adds a INNER JOIN clause to the query using the Form relation
 *
 * @method     ChildDashboardFormQuery joinWithForm($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Form relation
 *
 * @method     ChildDashboardFormQuery leftJoinWithForm() Adds a LEFT JOIN clause and with to the query using the Form relation
 * @method     ChildDashboardFormQuery rightJoinWithForm() Adds a RIGHT JOIN clause and with to the query using the Form relation
 * @method     ChildDashboardFormQuery innerJoinWithForm() Adds a INNER JOIN clause and with to the query using the Form relation
 *
 * @method     \FormsAPI\DashboardQuery|\FormsAPI\FormQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDashboardForm findOne(ConnectionInterface $con = null) Return the first ChildDashboardForm matching the query
 * @method     ChildDashboardForm findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDashboardForm matching the query, or a new ChildDashboardForm object populated from the query conditions when no match is found
 *
 * @method     ChildDashboardForm findOneById(int $id) Return the first ChildDashboardForm filtered by the id column
 * @method     ChildDashboardForm findOneByDashboardId(int $dashboard_id) Return the first ChildDashboardForm filtered by the dashboard_id column
 * @method     ChildDashboardForm findOneByFormId(int $form_id) Return the first ChildDashboardForm filtered by the form_id column *

 * @method     ChildDashboardForm requirePk($key, ConnectionInterface $con = null) Return the ChildDashboardForm by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDashboardForm requireOne(ConnectionInterface $con = null) Return the first ChildDashboardForm matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDashboardForm requireOneById(int $id) Return the first ChildDashboardForm filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDashboardForm requireOneByDashboardId(int $dashboard_id) Return the first ChildDashboardForm filtered by the dashboard_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDashboardForm requireOneByFormId(int $form_id) Return the first ChildDashboardForm filtered by the form_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDashboardForm[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDashboardForm objects based on current ModelCriteria
 * @method     ChildDashboardForm[]|ObjectCollection findById(int $id) Return ChildDashboardForm objects filtered by the id column
 * @method     ChildDashboardForm[]|ObjectCollection findByDashboardId(int $dashboard_id) Return ChildDashboardForm objects filtered by the dashboard_id column
 * @method     ChildDashboardForm[]|ObjectCollection findByFormId(int $form_id) Return ChildDashboardForm objects filtered by the form_id column
 * @method     ChildDashboardForm[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DashboardFormQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \FormsAPI\Base\DashboardFormQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\FormsAPI\\DashboardForm', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDashboardFormQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDashboardFormQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDashboardFormQuery) {
            return $criteria;
        }
        $query = new ChildDashboardFormQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildDashboardForm|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DashboardFormTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DashboardFormTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDashboardForm A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, dashboard_id, form_id FROM dashboard_form WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildDashboardForm $obj */
            $obj = new ChildDashboardForm();
            $obj->hydrate($row);
            DashboardFormTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildDashboardForm|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildDashboardFormQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DashboardFormTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDashboardFormQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DashboardFormTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDashboardFormQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DashboardFormTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DashboardFormTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DashboardFormTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the dashboard_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDashboardId(1234); // WHERE dashboard_id = 1234
     * $query->filterByDashboardId(array(12, 34)); // WHERE dashboard_id IN (12, 34)
     * $query->filterByDashboardId(array('min' => 12)); // WHERE dashboard_id > 12
     * </code>
     *
     * @see       filterByDashboard()
     *
     * @param     mixed $dashboardId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDashboardFormQuery The current query, for fluid interface
     */
    public function filterByDashboardId($dashboardId = null, $comparison = null)
    {
        if (is_array($dashboardId)) {
            $useMinMax = false;
            if (isset($dashboardId['min'])) {
                $this->addUsingAlias(DashboardFormTableMap::COL_DASHBOARD_ID, $dashboardId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dashboardId['max'])) {
                $this->addUsingAlias(DashboardFormTableMap::COL_DASHBOARD_ID, $dashboardId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DashboardFormTableMap::COL_DASHBOARD_ID, $dashboardId, $comparison);
    }

    /**
     * Filter the query on the form_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFormId(1234); // WHERE form_id = 1234
     * $query->filterByFormId(array(12, 34)); // WHERE form_id IN (12, 34)
     * $query->filterByFormId(array('min' => 12)); // WHERE form_id > 12
     * </code>
     *
     * @see       filterByForm()
     *
     * @param     mixed $formId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDashboardFormQuery The current query, for fluid interface
     */
    public function filterByFormId($formId = null, $comparison = null)
    {
        if (is_array($formId)) {
            $useMinMax = false;
            if (isset($formId['min'])) {
                $this->addUsingAlias(DashboardFormTableMap::COL_FORM_ID, $formId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formId['max'])) {
                $this->addUsingAlias(DashboardFormTableMap::COL_FORM_ID, $formId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DashboardFormTableMap::COL_FORM_ID, $formId, $comparison);
    }

    /**
     * Filter the query by a related \FormsAPI\Dashboard object
     *
     * @param \FormsAPI\Dashboard|ObjectCollection $dashboard The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDashboardFormQuery The current query, for fluid interface
     */
    public function filterByDashboard($dashboard, $comparison = null)
    {
        if ($dashboard instanceof \FormsAPI\Dashboard) {
            return $this
                ->addUsingAlias(DashboardFormTableMap::COL_DASHBOARD_ID, $dashboard->getId(), $comparison);
        } elseif ($dashboard instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DashboardFormTableMap::COL_DASHBOARD_ID, $dashboard->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDashboard() only accepts arguments of type \FormsAPI\Dashboard or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Dashboard relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDashboardFormQuery The current query, for fluid interface
     */
    public function joinDashboard($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Dashboard');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Dashboard');
        }

        return $this;
    }

    /**
     * Use the Dashboard relation Dashboard object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormsAPI\DashboardQuery A secondary query class using the current class as primary query
     */
    public function useDashboardQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDashboard($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Dashboard', '\FormsAPI\DashboardQuery');
    }

    /**
     * Filter the query by a related \FormsAPI\Form object
     *
     * @param \FormsAPI\Form|ObjectCollection $form The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDashboardFormQuery The current query, for fluid interface
     */
    public function filterByForm($form, $comparison = null)
    {
        if ($form instanceof \FormsAPI\Form) {
            return $this
                ->addUsingAlias(DashboardFormTableMap::COL_FORM_ID, $form->getId(), $comparison);
        } elseif ($form instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DashboardFormTableMap::COL_FORM_ID, $form->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByForm() only accepts arguments of type \FormsAPI\Form or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Form relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDashboardFormQuery The current query, for fluid interface
     */
    public function joinForm($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Form');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Form');
        }

        return $this;
    }

    /**
     * Use the Form relation Form object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FormsAPI\FormQuery A secondary query class using the current class as primary query
     */
    public function useFormQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinForm($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Form', '\FormsAPI\FormQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDashboardForm $dashboardForm Object to remove from the list of results
     *
     * @return $this|ChildDashboardFormQuery The current query, for fluid interface
     */
    public function prune($dashboardForm = null)
    {
        if ($dashboardForm) {
            $this->addUsingAlias(DashboardFormTableMap::COL_ID, $dashboardForm->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the dashboard_form table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DashboardFormTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DashboardFormTableMap::clearInstancePool();
            DashboardFormTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DashboardFormTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DashboardFormTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DashboardFormTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DashboardFormTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DashboardFormQuery